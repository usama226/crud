<?php

namespace App\Jobs;

use App\Mail\PostPublished;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPostPublishedEmail implements ShouldQueue
{
    use  Queueable;

    public $post;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send the email using the PostPublished Mailable
        Mail::to($this->post->user->email)->send(new PostPublished($this->post));
    }
}
