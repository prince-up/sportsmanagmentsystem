# Local Sports League Management System

A production-style local sports league platform built with Laravel, SQLite, Blade, TailwindCSS, Eloquent ORM, and Breeze-style authentication.

The system is designed to feel practical and human-made: clean tables, restrained UI, predictable workflows, and a data model that supports teams, players, matches, venues, seasons, injuries, transfers, voting, notifications, and league standings.

## Core Features

- Authentication with login, register, password reset, and email verification
- Role-based access for `admin` and `team_manager`
- Team management with logo upload, budget tracking, coach/contact details, and QR profile links
- Player management with jersey numbers, positions, age, ratings, injury status, and transfer history
- Match scheduling with live scores, highlights, MVP voting, and match history
- Automatic round-robin fixture generation
- Standings table with wins, draws, losses, goal difference, points, and fair play points
- Venue management with capacity and availability
- Multi-season support with active season toggles and archiving
- Dashboard analytics cards, upcoming matches, injuries, transfers, and standings snapshot
- API endpoints for standings and upcoming matches
- PDF export for league standings
- Dark mode toggle and responsive Blade UI

## Folder Structure

```text
app/
  Helpers/
    league.php
  Http/
    Controllers/
      Api/
      Auth/
    Middleware/
    Requests/
      Auth/
  Models/
  Policies/
  Providers/
  Services/
    League/
database/
  factories/
  migrations/
  seeders/
resources/
  css/
  js/
  views/
    auth/
    components/
    exports/
    injuries/
    league/
    layouts/
    matches/
    players/
    seasons/
    teams/
    transfers/
    venues/
routes/
  api.php
  auth.php
  console.php
  web.php
```

## Installation From Zero

### 1. Prerequisites

- PHP 8.3+
- Composer
- Node.js 20+
- SQLite

### 2. Create the project

If you are starting from scratch in a new folder:

```powershell
composer create-project laravel/laravel local-sports-league-management-system
cd local-sports-league-management-system
```

If you are using this repository directly, install dependencies instead:

```powershell
composer install
npm install
```

### 3. Install Breeze authentication

```powershell
composer require laravel/breeze --dev
php artisan breeze:install blade
```

### 4. Set up SQLite

```powershell
New-Item -ItemType File -Force database\database.sqlite
```

Update `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### 5. Generate app key and run migrations

```powershell
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

### 6. Run the frontend and app server

```powershell
npm run dev
php artisan serve
```

## Useful Laravel Commands

### Migrations

```powershell
php artisan migrate
php artisan migrate:fresh --seed
php artisan migrate:status
```

### Seeders

```powershell
php artisan db:seed
php artisan db:seed --class=LeagueSeeder
```

### Build for deployment

```powershell
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Database Schema

### `users`
- `name`, `email`, `password`
- `role` supports `admin` and `team_manager`
- `phone`, `avatar_path`

### `seasons`
- `name`, `starts_on`, `ends_on`
- `is_active` for the current season
- `archived_at` for closed seasons

### `teams`
- Belongs to `season` and optional creator `user`
- `name`, `slug`, `logo_path`, `coach_name`, `city`
- `contact_email`, `contact_phone`
- `budget`, `spent_budget`, `fair_play_points`, `qr_code`, `notes`

### `venues`
- Belongs to `season`
- `name`, `city`, `location`, `capacity`, `availability_status`

### `players`
- Belongs to `team` and `season`
- `full_name`, `slug`, `jersey_number`, `position`
- `date_of_birth`, `age`, `goals`, `assists`, `appearances`
- `yellow_cards`, `red_cards`, `rating`, `injury_status`, `market_value`

### `matches`
- Belongs to `season`, `venue`, `home_team`, `away_team`, optional `mvp_player`
- `match_date`, `status`, `live_status`
- `home_score`, `away_score`, `highlights`, `round_number`, `notes`

### `injuries`
- Belongs to `player`, `team`, and `season`
- `injury_type`, `severity`, `started_at`, `expected_return_at`, `recovered_at`
- `recovery_progress`, `notes`

### `transfers`
- Belongs to `player`, `from_team`, `to_team`, and `season`
- `transfer_date`, `transfer_fee`, `status`, `notes`

### `player_votes`
- Belongs to `match`, `player`, and voting `user`
- `points`, `reason`

### `league_notifications`
- Belongs to `user`
- `title`, `message`, `type`, `metadata`, `is_read`

## Seeded Demo Data

The seeder creates realistic demo content:

- 1 active season
- 1 archived season
- 6 teams
- 15 players per team
- Multiple venues
- Scheduled and completed matches
- Injuries, transfers, votes, and notifications

## Key Services

- `App\Services\League\StandingsService` computes rankings
- `App\Services\League\FixtureGeneratorService` builds round-robin fixtures
- `App\Services\League\PredictionService` produces lightweight match predictions
- `App\Services\League\TransferMarketService` simulates transfer decisions
- `App\Services\League\NotificationService` stores league notifications

## API Endpoints

Authentication is handled with Sanctum for API access.

### `GET /api/v1/standings`

Example response:

```json
{
  "season": "2026 Local League Season",
  "data": [
    {
      "team_id": 1,
      "team_name": "Northside Rovers",
      "played": 8,
      "wins": 6,
      "draws": 1,
      "losses": 1,
      "goals_for": 18,
      "goals_against": 9,
      "goal_difference": 9,
      "points": 19,
      "fair_play_points": 12,
      "budget": 145000
    }
  ]
}
```

### `GET /api/v1/matches/upcoming`

Example response:

```json
{
  "data": [
    {
      "id": 12,
      "home_team": "Northside Rovers",
      "away_team": "Central United",
      "match_date": "2026-06-02 18:30:00",
      "venue": "River Park Ground",
      "prediction": {
        "winner": "Northside Rovers",
        "home_score": 2,
        "away_score": 1,
        "confidence": 74
      }
    }
  ]
}
```

## Dashboard Pages

- Dashboard with summary cards, standings snapshot, upcoming matches, recent transfers, and injured players
- League table with PDF export
- Teams index, create, edit, and public QR profile page
- Players index and form
- Matches index with fixture scheduling and prediction display
- Venues index with inline create form
- Seasons index with active season toggle and archive action
- Transfers index with inline transfer logging
- Injuries index with inline recovery tracking
- Auth pages for login, register, reset password, and email verification

## Notes On Routing And Roles

- `auth` protects the app pages
- `role:admin` middleware is available for admin-only areas
- Breeze auth routes are included in `routes/auth.php`
- Team QR codes resolve to public team profile URLs

## Future Improvements

- Add a dedicated public profile page for teams and players
- Move inline create forms into modals or dedicated admin screens
- Add richer charts for goals, form, injuries, and transfer market trends
- Persist live match commentary events
- Add export options for CSV and Excel
- Add cached standings snapshots for very large leagues
- Add notifications to email / SMS delivery channels

## Deployment Checklist

```powershell
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## License

MIT
