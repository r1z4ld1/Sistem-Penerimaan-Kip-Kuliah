<?php

namespace App\Services;

use App\Models\User;
use App\Models\Notification;
use App\Enums\NotificationTypeEnum;

class NotificationService
{
    /*
    |--------------------------------------------------------------------------
    | CREATE NOTIFICATION
    |--------------------------------------------------------------------------
    */

    public function create(
        User $user,
        string $title,
        string $message,
        NotificationTypeEnum $type
    ) {

        return Notification::create([

            'user_id' => $user->id,

            'title' => $title,

            'message' => $message,

            'type' => $type,

            'is_read' => false,
        ]);
    }
}
