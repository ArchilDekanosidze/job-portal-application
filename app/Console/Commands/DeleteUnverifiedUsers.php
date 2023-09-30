<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteUnverifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:unverifiedusersp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unverified accounts';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        User::whereNull('email_verified_at')
        ->where('created_at', '<=', Carbon::now()->subDays(30))
        ->delete();
    }
}
