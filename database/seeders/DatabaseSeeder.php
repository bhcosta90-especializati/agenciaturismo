<?php

namespace Database\Seeders;

use App\Models\{City, State};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!\App\Models\User::where('email', $email = 'local@local.com')->count()) {
            \App\Models\User::factory()->create([
                'email' => $email,
                'api_token' => '7e2dc512e7a737eabc7a4c36911a64b4436a12978706cb871f928cb143fd1b18',
            ]);
        }
        \App\Models\User::factory(rand(5, 15))->create();
    }
}
