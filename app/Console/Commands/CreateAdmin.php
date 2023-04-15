<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Name');
        $email = $this->ask('Email');
        $password = $this->secret('Password');

        $check = User::where('email',$email)->first();
        if($check){
            $this->error('Email already exist !!');
        }else{
            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password =  Hash::make($password);
            $user->type = 'admin';
            $user->save();
            $this->info('Admin user successfully created !!');
        }
    }
}
