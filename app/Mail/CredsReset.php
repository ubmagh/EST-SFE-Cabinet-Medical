<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CredsReset extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $pseudo;
        public $url;

    public function __construct($pseudo,$url)
    {
        //
        $this->pseudo = $pseudo;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(" Cabinet App: Mot de passe ou Pseudo Oublié ")->markdown('Emails.CredsReset');
    }
}