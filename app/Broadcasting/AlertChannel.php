<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;


class AlertChannel implements ShouldBroadcastNow
{
    public $message;

    use Dispatchable;

    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        //
        $this->message = $message;
    }

//    /**
//     * Authenticate the user's access to the channel.
//     *
//     * @param  \App\Models\User  $user
//     * @return array|bool
//     */
//    public function join(User $user)
//    {
//        //
//    }

    public function broadcastOn()
    {
        return new Channel('alert');
    }
}
