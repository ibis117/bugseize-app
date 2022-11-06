<?php

namespace App\Broadcasting;

use App\Models\BugException;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class RecentExceptionChannel implements ShouldBroadcastNow
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public BugException $exception;
    public string $user_id;

    /**
     * Create a new channel instance.
     *
     * @return void
     */

    public function __construct(BugException $exception, $user_id)
    {
        $this->exception = $exception;
        $this->user_id = $user_id;
    }

    public function broadcastWith()
    {
        return [
            'exception' => $this->exception,
        ];
    }

//    /**
//     * Authenticate the user's access to the channel.
//     *
//     * @param  \App\Models\User  $user
//     * @return array|bool
//     */
//    public function join(User $user)
//    {
//        return $user
//    }

    public function broadcastOn()
    {
        $name = "recent-exception#{$this->user_id}";
        return new Channel($name);
    }
}
