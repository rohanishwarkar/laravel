<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
		//   echo "ROhannn";
		  $va = $this->user;
		  print_r($va);
		  return $this->view('verifyEmail')
						  ->with([
								'name' => $this->user->name,
								'email_verification_token' => '00000'
							]);
    }
}