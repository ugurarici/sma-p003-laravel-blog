<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class PostReminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $posts;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Collection $posts)
    {
        $this->user = $user;
        $this->posts = $posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Hey ' . $this->user->name . '! ' . $this->posts->count() . ' new post for you!')
            ->markdown('email.posts.reminder');
    }
}
