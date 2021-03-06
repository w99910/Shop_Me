<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    public $carts;
    public $total_price;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($carts,$totalprice)
    {
        $this->carts=$carts;
        $this->total_price=$totalprice;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->markdown('emails.Invoice');
        return $this->view('mails.invoice_paid');
    }
}
