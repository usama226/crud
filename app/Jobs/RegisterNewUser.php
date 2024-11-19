<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\RegiserUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterNewUser implements ShouldQueue
{
    use Queueable;
    public $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new RegiserUser($this->user));
    }
}
