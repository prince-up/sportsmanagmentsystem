<?php

namespace Database\Seeders;

use App\Models\Injury;
use App\Models\LeagueNotification;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\PlayerVote;
use App\Models\Season;
use App\Models\Team;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Venue;
use App\Services\League\FixtureGeneratorService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LeagueSeeder extends Seeder
{
    public function __construct(private readonly FixtureGeneratorService $fixtureGeneratorService)
    {
    }

    public function run(): void
    {
        DB::transaction(function () {
            $admin = User::factory()->admin()->create([
                'name' => 'Admin User',
                'email' => 'admin@league.local',
            ]);

            $manager = User::factory()->state([
                'name' => 'Team Manager',
                'email' => 'manager@league.local',
                'role' => 'team_manager',
            ])->create();

            $activeSeason = Season::factory()->active()->create([
                'name' => '2026 Local League Season',
                'starts_on' => now()->subWeeks(3)->toDateString(),
                'ends_on' => now()->addMonths(4)->toDateString(),
            ]);

            $pastSeason = Season::factory()->create([
                'name' => '2025 Local League Season',
                'starts_on' => now()->subYear()->subMonths(2)->toDateString(),
                'ends_on' => now()->subMonths(6)->toDateString(),
                'archived_at' => now()->subMonths(5),
            ]);

            $venues = Venue::factory()->count(4)->create([
                'season_id' => $activeSeason->id,
            ]);

            $teamNames = [
                'Northside Rovers',
                'Central United',
                'Riverfront Athletic',
                'Harbor City FC',
                'Greenfield Strikers',
                'Southgate Warriors',
            ];

            $teams = collect($teamNames)->map(function (string $teamName) use ($activeSeason, $admin) {
                return Team::query()->create([
                    'season_id' => $activeSeason->id,
                    'created_by' => $admin->id,
                    'name' => $teamName,
                    'slug' => Str::slug($teamName),
                    'logo_path' => null,
                    'coach_name' => fake()->name(),
                    'city' => fake()->city(),
                    'contact_email' => fake()->safeEmail(),
                    'contact_phone' => fake()->phoneNumber(),
                    'budget' => fake()->numberBetween(85000, 180000),
                    'spent_budget' => fake()->numberBetween(25000, 90000),
                    'fair_play_points' => fake()->numberBetween(5, 18),
                    'qr_code' => url('/teams/' . Str::slug($teamName)),
                    'is_active' => true,
                    'notes' => fake()->optional()->sentence(),
                ]);
            });

            foreach ($teams as $index => $team) {
                Player::factory()
                    ->count(15)
                    ->create([
                        'team_id' => $team->id,
                        'season_id' => $activeSeason->id,
                    ])
                    ->each(function (Player $player, int $playerIndex) use ($team, $venues, $activeSeason) {
                        if ($playerIndex === 0) {
                            $player->update(['is_captain' => true, 'rating' => 8.4]);
                        }

                        if (fake()->boolean(12)) {
                            Injury::factory()->create([
                                'player_id' => $player->id,
                                'team_id' => $team->id,
                                'season_id' => $activeSeason->id,
                            ]);
                        }
                    });
            }

            $fixtures = $this->fixtureGeneratorService->generate($activeSeason);

            foreach ($fixtures->take(12) as $index => $fixture) {
                $match = MatchModel::query()->create(array_merge($fixture, [
                    'venue_id' => $venues[$index % $venues->count()]->id,
                    'status' => $index % 3 === 0 ? 'completed' : 'scheduled',
                    'home_score' => $index % 3 === 0 ? fake()->numberBetween(0, 4) : 0,
                    'away_score' => $index % 3 === 0 ? fake()->numberBetween(0, 4) : 0,
                    'highlights' => $index % 3 === 0 ? fake()->sentence() : null,
                ]));

                if ($match->status === 'completed') {
                    $match->update([
                        'mvp_player_id' => Player::query()->where('team_id', $match->home_team_id)->inRandomOrder()->value('id'),
                    ]);
                }
            }

            $players = Player::query()->limit(10)->get();
            foreach ($players as $player) {
                Transfer::factory()->create([
                    'player_id' => $player->id,
                    'from_team_id' => $player->team_id,
                    'to_team_id' => $teams->where('id', '!=', $player->team_id)->random()->id,
                    'season_id' => $activeSeason->id,
                ]);
            }

            MatchModel::query()->where('status', 'completed')->take(5)->get()->each(function (MatchModel $match) use ($manager) {
                $player = Player::query()->whereIn('team_id', [$match->home_team_id, $match->away_team_id])->inRandomOrder()->first();
                if ($player) {
                    PlayerVote::factory()->create([
                        'match_id' => $match->id,
                        'player_id' => $player->id,
                        'voted_by_user_id' => $manager->id,
                    ]);
                }
            });

            LeagueNotification::factory()->count(8)->create([
                'user_id' => $manager->id,
            ]);

            $this->command?->info('Seeded 1 active season, 6 teams, 90 players, venues, matches, injuries, and transfers.');
        });
    }
}