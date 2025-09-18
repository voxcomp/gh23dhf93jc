<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PayRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $registrant;

    public $subject;

    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registrant)
    {
        $this->registrant = $registrant;
        $this->link = config('app.url').'/payment-request/'.encrypt($registrant->invoice);
        $this->subject = 'Brancel Bicycle Charters RAGBRAI Registration Payment';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->view('mail.payrequest')->text('mail.payrequest_plain');
    }
}
