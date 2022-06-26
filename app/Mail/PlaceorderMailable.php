<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Auth;
use App\User;

class PlaceorderMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $order_data;
    public $items_in_cart;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_data, $items_in_cart)
    {
        $this->order_data = $order_data;
        $this->items_in_cart = $items_in_cart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        $from_name = "Real Value Enterprise";
	#$from_email = "enterpriserealvalue@gmail.com";
        $from_email = env('MAIL_USERNAME');
        $subject = "Your order has been placed";
        $try = User::where('id',Auth::id())->get();
        return $this->from($from_email, $from_name)
            // ->view('emails.order-confirmation',compact('try'))
            ->view('emails.receipt',compact('try'))
            ->subject($subject);
    }
}
