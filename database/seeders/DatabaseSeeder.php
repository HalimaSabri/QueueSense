<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@queuesense.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Agent
        $agent = User::factory()->create([
            'name' => 'Agent Smith',
            'email' => 'agent@queuesense.com',
            'password' => Hash::make('password'),
            'role' => 'agent',
        ]);

        // Services
        $s1 = Service::create(['name' => 'Customer Support', 'average_time' => 15]);
        $s2 = Service::create(['name' => 'Technical Support', 'average_time' => 20]);
        $s3 = Service::create(['name' => 'Billing Inquiry', 'average_time' => 10]);

        $agent->services()->attach([$s1->id, $s2->id, $s3->id]);
    }
}
