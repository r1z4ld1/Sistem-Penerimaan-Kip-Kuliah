<?php

namespace App\Views\Composers;

use App\Models\Notification;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationComposer
{
    public function compose(View $view)
    {
        if (!Auth::check()) {
            return;
        }

        $unreadNotifications = Notification::where(
            'user_id',
            Auth::id()
        )
            ->where(
                'is_read',
                false
            )
            ->latest()
            ->take(5)
            ->get();

        $unreadCount = Notification::where(
            'user_id',
            Auth::id()
        )
            ->where(
                'is_read',
                false
            )
            ->count();

        $view->with([
            'unreadNotifications' => $unreadNotifications,
            'unreadCount' => $unreadCount,
        ]);
    }
}
