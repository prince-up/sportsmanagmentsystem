<?php

namespace App\Services\League;

use App\Events\LeagueNotificationCreated;
use App\Models\LeagueNotification;
use App\Models\User;

class NotificationService
{
    public function sendToUser(User $user, string $title, string $message, string $type = 'system', array $metadata = []): LeagueNotification
    {
        $notification = LeagueNotification::query()->create([
            'user_id' => $user->id,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'metadata' => $metadata,
            'is_read' => false,
        ]);

        event(new LeagueNotificationCreated($notification));

        return $notification;
    }
}