<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FormSubmitted implements ShouldBroadcast
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $text;
    public $text1;
    public $text2;
    public $text3;
    public $text4;
    public $text5;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($text,$text1,$text2,$text3,$text4,$text5)
    {
        $this->text = $text;
        $this->text1 = $text1;
        $this->text2 = $text2;
        $this->text3 = $text3;
        $this->text4 = $text4;
        $this->text5 = $text5;
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
        return 'form-submitted';
    }
}
