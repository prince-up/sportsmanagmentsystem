<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('users.{userId}', function ($user, int $userId) {
    return (int) $user->id === $userId;
});

Broadcast::channel('league.season.{seasonId}', function ($user, int $seasonId) {
    return $user->isAdmin() || $user->isManager();
});