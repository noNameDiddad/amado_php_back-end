<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Please log in:");
        $email = $this->ask('email');
        if ($user = User::where('email', $email)->first())
        {
            $password = $this->secret('password:');
            if ($email == $user->email && Hash::check($password, $user->password, []) )  {
                if ($user->role == 1) {
                    $this->info("Enter the details of the new user:");
                    $new_user_email = $this->ask('email');
                    $new_user_name = $this->ask('name');
                    $new_user_password = $this->secret('password:');
                    $check_password = $this->secret('repeat password:');
                    if ($new_user_password == $check_password) {
                        $new_user = new User();

                        $new_user->email = $new_user_email;
                        $new_user->name = $new_user_name;
                        $new_user->password = bcrypt($new_user_password);
                        $new_user->email_verified_at = now();
                        $new_user->remember_token =  Str::random(10);

                        $new_user->save();
                        $this->info("User created");
                        info('user created email: ' . $new_user_email . ' password: ' . $new_user_password);
                    }else {
                        $this->info("Password mismatch");
                        info('Erroneous create user - error:Password mismatch');
                    }
                }else {
                    $this->info("You lack rights");
                    info('Erroneous create user - error:You lack rights');
                }
            } else {
                $this->info("Passwords mismatch");
                info('Erroneous login attempt'.$email.' '.$password.' - error:Passwords mismatch');
            }
        }else {
            $this->info("User does not exist");
            info('Erroneous login attempt'.$email.' - error:User does not exist');
        }
        return Command::SUCCESS;
    }
}
