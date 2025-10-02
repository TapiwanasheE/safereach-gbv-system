<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed the roles
        $this->call(RoleSeeder::class);

        // Create Super User (Admin)
        $superUserRole = Role::where('name', 'Super User')->first();

        if ($superUserRole) {
            // Create default admin user
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@safereach.com',
                'password' => Hash::make('Admin@123'),
                'role_id' => $superUserRole->id,
            ]);

            // Create another admin user
            User::create([
                'name' => 'Leon Admin',
                'email' => 'leon@gmail.com',
                'password' => Hash::make('Naruto@04'),
                'role_id' => $superUserRole->id,
            ]);
        }

        // Optional: Create sample users for other roles
        $medicalRole = Role::where('name', 'Medical')->first();
        if ($medicalRole) {
            User::create([
                'name' => 'Medical Officer',
                'email' => 'medical@safereach.com',
                'password' => Hash::make('Medical@123'),
                'role_id' => $medicalRole->id,
            ]);
        }

        $counselorRole = Role::where('name', 'Counselor')->first();
        if ($counselorRole) {
            User::create([
                'name' => 'Counselor Staff',
                'email' => 'counselor@safereach.com',
                'password' => Hash::make('Counselor@123'),
                'role_id' => $counselorRole->id,
            ]);
        }

        $lawRole = Role::where('name', 'Law Enforcement')->first();
        if ($lawRole) {
            User::create([
                'name' => 'Law Enforcement Officer',
                'email' => 'law@safereach.com',
                'password' => Hash::make('Law@123'),
                'role_id' => $lawRole->id,
            ]);
        }

        $victimRole = Role::where('name', 'Victim')->first();
        if ($victimRole) {
            User::create([
                'name' => 'Test Victim',
                'email' => 'victim@safereach.com',
                'password' => Hash::make('Victim@123'),
                'role_id' => $victimRole->id,
            ]);
        }
    }
}
