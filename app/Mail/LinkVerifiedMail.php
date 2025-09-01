<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LinkVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verifiedUrl;
    public $expired;

    public function __construct(User $user, string $verifiedUrl, int $expired)
    {
        $this->user = $user;
        $this->verifiedUrl = $verifiedUrl;
        $this->expired = $expired;
    }

    public function build()
    {
        return $this->subject('Verified Email - ' . config('app.name'))
            ->view('Emails.link-verified')
            ->with([
                'user' => $this->user,
                'verifiedUrl' => $this->verifiedUrl,
                'expired' => $this->expired
            ]);
    }
}
