<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;

class TeamPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isManager();
    }

    public function view(User $user, Team $team): bool
    {
        return $user->isAdmin() || (int) $team->created_by === (int) $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isManager();
    }

    public function update(User $user, Team $team): bool
    {
        return $this->view($user, $team);
    }

    public function delete(User $user, Team $team): bool
    {
        return $user->isAdmin();
    }
}