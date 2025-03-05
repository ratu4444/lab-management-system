<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $message_content;
    public $admin;


    public function __construct($message_content, $admin )
    {
        $this->message_content = $message_content;
        $this->admin = $admin;
    }


    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->subject('Notification from Superadmin')
            ->view('mail.admin-notification')
            ->with([
                'message_content' => $this->message_content,
                'admin' => $this->admin
            ]);

    }
}
