<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        (new RolesAndPermissionsSeeder)->run();

        \App\Models\User::factory(5)->create();

        Course::factory(6)->create();

    }
}
