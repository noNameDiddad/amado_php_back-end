<?php


namespace App\NotificationItems;


use App\Models\User;

class PictureAddedNotifications
{
    public function unreadNotifications()
    {
        $unreadNotifications = [];
        $users = User::all();
        foreach ($users as $user) {
            foreach ($user->unreadNotifications as $notification) {
                $unreadNotificationsItem = [
                    'id' => $notification->id,
                    'user_id' => $user->id,
                    'username' => $user->name,
                    'painter' => $notification->data['painter'],
                    'number' => $notification->data['number'],
                    'created_at' => $notification->created_at,
                ];
                array_push($unreadNotifications, $unreadNotificationsItem);
            }
        }
        return $unreadNotifications;
    }

    public function withoutUnreadNotifications()
    {
        $withoutUnreadNotifications = [];
        $users = User::all();
        foreach ($users as $user) {
            foreach ($user->notifications as $notification) {
                if ($notification->read_at != null) {
                    $withoutUnreadNotificationsItem = [
                        'id' => $notification->id,
                        'user_id' => $user->id,
                        'username' => $user->name,
                        'painter' => $notification->data['painter'],
                        'number' => $notification->data['number'],
                        'created_at' => $notification->created_at,
                    ];
                    array_push($withoutUnreadNotifications, $withoutUnreadNotificationsItem);
                }
            }

        }
        return $withoutUnreadNotifications;
    }
}
