<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SocketNotificationOfNewCityStep implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $city_step;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($city_step)
    {
        $this->city_step = $city_step;
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
