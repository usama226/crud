<?php

namespace App\Jobs;

use App\Models\Post;
use App\Mail\PostUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class postUpdate implements ShouldQueue
{
    use Queueable;
    public $post;
    /**
     * Create a new job instance.
     */
    public function __construct(Post $post )
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->post->user->email)->send(new PostUpdated($this->post));
    }
}
