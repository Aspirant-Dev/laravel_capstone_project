<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminDashboard implements ShouldBroadcast
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $data1;
    public $data2;
    public $data3;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data,$data1,$data2,$data3)
    {
        $this->data = $data;
        $this->data1 = $data1;
        $this->data2 = $data2;
        $this->data3 = $data3;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('my-channel');
    }
    public function broadcastAs()
    {
        return 'admin-dashboard-update';
    }
}
