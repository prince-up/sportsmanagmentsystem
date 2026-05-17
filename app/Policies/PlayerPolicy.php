<?php

namespace App\Policies;

use App\Models\Player;
use App\Models\User;

class PlayerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isManager();
    }

    public function view(User $user, Player $player): bool
    {
        return $user->isAdmin() || (int) $player->team?->created_by === (int) $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isManager();
    }

    public function update(User $user, Player $player): bool
    {
        return $this->view($user, $player);
    }

    public function delete(User $user, Player $player): bool
    {
        return $user->isAdmin();
    }
}