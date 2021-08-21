<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostReminder;

class SendReminderMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();

        $users->each(function ($user) {
            $newPostsForUser = Post::query()
                ->whereIn('category_id', $user->followedCategories()->pluck('id'))
                ->where('created_at', '>=', now()->subWeek())
                ->orderBy('created_at', 'ASC')
                ->get();

            if ($newPostsForUser->count() > 0) {
                Mail::to($user)->send(new PostReminder($user, $newPostsForUser));
            }
        });
    }
}
