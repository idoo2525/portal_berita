<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $adminEmail = config('admin.email');
        $adminPassword = config('admin.password');

        if (blank($adminEmail) || blank($adminPassword)) {
            return;
        }

        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => config('admin.name'),
                'password' => $adminPassword,
                'is_admin' => true,
            ],
        );
    }
}
