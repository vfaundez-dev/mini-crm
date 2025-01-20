<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactDepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $contact_departments = [
            ['id' => 1, 'department' => 'Human Resources'],
            ['id' => 2, 'department' => 'Finance'],
            ['id' => 3, 'department' => 'Marketing'],
            ['id' => 4, 'department' => 'Sales'],
            ['id' => 5, 'department' => 'Information Technology'],
            ['id' => 6, 'department' => 'Operations'],
            ['id' => 7, 'department' => 'Customer Service'],
            ['id' => 8, 'department' => 'Product Development'],
            ['id' => 9, 'department' => 'Research and Development'],
            ['id' => 10, 'department' => 'Legal'],
            ['id' => 11, 'department' => 'Administration'],
            ['id' => 12, 'department' => 'Logistics'],
            ['id' => 13, 'department' => 'Procurement'],
            ['id' => 14, 'department' => 'Quality Assurance'],
            ['id' => 15, 'department' => 'Public Relations'],
            ['id' => 16, 'department' => 'Training and Development'],
            ['id' => 17, 'department' => 'Security'],
            ['id' => 18, 'department' => 'Engineering'],
            ['id' => 19, 'department' => 'Business Development'],
            ['id' => 20, 'department' => 'Compliance'],
            ['id' => 21, 'department' => 'Health and Safety'],
        ];

        DB::table('contact_departments')->insert($contact_departments);
    }
}
