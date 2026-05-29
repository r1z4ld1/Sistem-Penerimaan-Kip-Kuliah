<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        Notification::where(
            'user_id',
            auth()->id()
        )
            ->where(
                'is_read',
                false
            )
            ->update([

                'is_read' => true,

                'read_at' => now()
            ]);

        $notifications = Notification::where(
            'user_id',
            auth()->id()
        )
            ->latest()
            ->paginate(10);

        return view(
            'notifications.index',
            compact('notifications')
        );
    }

    public function latest()
    {
        $notification = auth()->user()
            ->notifications()
            ->latest()
            ->first();

        if (!$notification) {
            return response()->json(null);
        }

        return response()->json([
            'id' => $notification->id,
            'title' => $notification->title,
            'message' => $notification->message,
            'type' => $notification->type->value,
        ]);
    }
}
