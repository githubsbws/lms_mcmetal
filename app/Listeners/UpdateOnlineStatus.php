<?php

namespace App\Listeners;

use App\Events\SessionEnded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Users;

class UpdateOnlineStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SessionEnded $event)
    {
        $user = Users::find($event->userId);
        if ($user) {
            $user->online_status = 0;
            $user->save();
        }
    }
}
