<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class CreateSuperUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--u|username= : Username of the newly created user.} {--e|email= : E-Mail of the newly created user.} {--name|name= : Name of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually creates a new laravel user.';

    /**
     * Execute the console command.
     * https://laravel.com/docs/9.x/artisan
     *
     * @return int
     */
    public function handle()
    {
        // Enter username, if not present via command line option
        $username = $this->option('username');
        if ($username === null) {
            $username = $this->ask('Please enter your username.');
        }

        // Enter email, if not present via command line option
        $email = $this->option('email');
        if ($email === null) {
            $email = $this->ask('Please enter your E-Mail.');
        }
		
		$name = $this->option('name');
        if ($name === null) {
            $name = $this->ask('Whats Your Name ?');
        }
		
        // Always enter password from userinput for more security.
        $password = $this->secret('Please enter a new password.');
        $password_confirmation = $this->secret('Please confirm the password');

        try {
            // Use fortify to create a new user.
            $user = new Admin();
			$user->password = Hash::make($password);
			$user->username = $username;
			$user->name = $name;
			$user->email = $email;
			$user->save();
        }
        catch (\Exception $e) {
            $this->error($e->getMessage());
            return;
        }

        // Success message
        $this->info('User created successfully!');
        $this->info('New user id: ' . $user->id);
    }
}