<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPostOnFollowedCategory;

class SendNewPostOnFollowedCategoryMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        foreach ($event->post->category->followers as $follower) {
            if ($event->post->user->id === $follower->id) continue;
            Mail::to($follower)->send(new NewPostOnFollowedCategory($event->post));
        }
    }
}
