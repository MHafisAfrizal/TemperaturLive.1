<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {

        // check if admin user exists
        if ( ! \App\Models\User::where( 'email', 'admin@admin.com' )->exists() ) {
            \App\Models\User::factory()->create( [
                'name'              => 'Admin',
                'email'             => 'admin@admin.com',
                'password'          => bcrypt( 'password' ),
                'email_verified_at' => now(),
            ] );
        }

        $this->call( [
            RoomSeeder::class,
        ] );
    }
}