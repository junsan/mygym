<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Jun',
            'email' => 'Jun@info.com'
        ]);

        User::factory()->create([
            'name' => 'Jay',
            'email' => 'jay@info.com',
            'role' => 'instructor'
        ]);

        User::factory()->create([
            'name' => 'M',
            'email' => 'm@info.com',
            'role' => 'admin'
        ]);

        User::factory()->count(15)->create();

        User::factory()->count(10)->create([
            'role' => 'instructor'
        ]);

    }
}
