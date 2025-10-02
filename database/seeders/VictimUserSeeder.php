<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class VictimUserSeeder extends Seeder
{
    public function run()
    {
        $victimRole = Role::where('name', 'Victim')->first();

        if ($victimRole) {
            // Check if victim user already exists
            $existingVictim = User::where('email', 'victim@safereach.com')->first();

            if (!$existingVictim) {
                User::create([
                    'name' => 'Test Victim',
                    'email' => 'victim@safereach.com',
                    'password' => Hash::make('Victim@123'),
                    'role_id' => $victimRole->id,
                ]);

                echo "Victim user created successfully!\n";
            } else {
                echo "Victim user already exists.\n";
            }
        } else {
            echo "Victim role not found!\n";
        }
    }
}

