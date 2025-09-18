<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Registration extends Mailable
{
    use Queueable, SerializesModels;

    public $registrant;

    public $subject;
    // public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registrant)
    {
        $this->registrant = $registrant;
        // $this->link = config('app.url').'/wristband';
        $this->subject = 'Brancel Bicycle Charters RAGBRAI Registration';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.registration')->text('mail.registration_plain');
    }
}
