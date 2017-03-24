<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SocketNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    const NEW_CITY_STEP = 'new city step';
    const PLAYER_LOGIN = 'player login';
    const PLAYER_LOGOUT = 'player logout';
    const PLAYER_CHANGE_AVATAR = 'player new avatar';

    public $type;
    public $data;

    /**
     * Create a new event instance.
     *
     * @param string $type
     * @param mixed $data
     */
    public function __construct($type, $data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('users');
    }
}
