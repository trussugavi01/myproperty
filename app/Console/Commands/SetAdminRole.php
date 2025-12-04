<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetAdminRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:set-admin {email : The email address of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set a user as admin by email address';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return Command::FAILURE;
        }

        if ($user->role === 'admin') {
            $this->info("User '{$email}' is already an admin.");
            return Command::SUCCESS;
        }

        $user->update(['role' => 'admin']);

        $this->info("Successfully set '{$email}' as admin.");
        $this->info("User: {$user->name}");
        $this->info("Role: {$user->role}");

        return Command::SUCCESS;
    }
}
