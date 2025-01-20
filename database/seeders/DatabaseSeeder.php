<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ActivityTypesTableSeeder::class,
            ClientIndustriesTableSeeder::class,
            ClientStatusTableSeeder::class,
            ClientTypesTableSeeder::class,
            ContactDepartmentsTableSeeder::class,
            ContactJobTitlesTableSeeder::class,
            OpportunityStagesTableSeeder::class,
        ]);
    }
}
