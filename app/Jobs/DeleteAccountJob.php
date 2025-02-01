<?php

namespace App\Jobs;

use App\Models\Account;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

class DeleteAccountJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    protected $accountId;

    /**
     * Create a new job instance.
     */
    public function __construct($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $account = Account::find($this->accountId);
        
        if ($account) {
            $account->delete(); 
        }
    }
}
