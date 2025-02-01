<?php

namespace App\Jobs;

use App\Mail\SubscriptionEndingMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifySubscriptionEndJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    protected $email;
    public $userName;
    public $subscriptionEndDate;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $userName, $subscriptionEndDate)
    {
        $this->email = $email;
        $this->userName = $userName;
        $this->subscriptionEndDate = $subscriptionEndDate;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new SubscriptionEndingMail($this->userName, $this->subscriptionEndDate));
    }
}
