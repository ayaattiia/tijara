<?php

namespace App\Console\Commands;

use App\Models\Users;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'app:create-admin {email} {password} {username=admin}';
    protected $description = 'Crée un compte administrateur (IdRole=3)';

    public function handle()
    {
        $email = $this->argument('email');

        if (Users::where('Email', $email)->exists()) {
            $this->error('Un utilisateur avec cet email existe déjà.');
            return 1;
        }

        $user = Users::create([
            'Username'       => $this->argument('username'),
            'Email'          => $email,
            'Password'       => Hash::make($this->argument('password')),
            'IdRole'         => 3, // admin
            'Active'         => 1,
            'EmailConfirmed' => 1,
            'CreationDate'   => now(),
        ]);

        $this->info("Admin créé avec succès : {$user->Email} (IdUser={$user->IdUser})");
        return 0;
    }
}
