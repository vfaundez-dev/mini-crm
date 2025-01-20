<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactJobTitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $contact_job_titles = [
            ['id' => 1, 'job_title' => 'Chief Executive Officer (CEO)'],
            ['id' => 2, 'job_title' => 'Chief Operating Officer (COO)'],
            ['id' => 3, 'job_title' => 'Chief Financial Officer (CFO)'],
            ['id' => 4, 'job_title' => 'Chief Marketing Officer (CMO)'],
            ['id' => 5, 'job_title' => 'Chief Technology Officer (CTO)'],
            ['id' => 6, 'job_title' => 'President'],
            ['id' => 7, 'job_title' => 'Vice President (VP)'],
            ['id' => 8, 'job_title' => 'General Manager'],
            ['id' => 9, 'job_title' => 'Operations Manager'],
            ['id' => 10, 'job_title' => 'Marketing Manager'],
            ['id' => 11, 'job_title' => 'Sales Manager'],
            ['id' => 12, 'job_title' => 'Product Manager'],
            ['id' => 13, 'job_title' => 'Project Manager'],
            ['id' => 14, 'job_title' => 'Human Resources Manager'],
            ['id' => 15, 'job_title' => 'IT Manager'],
            ['id' => 16, 'job_title' => 'Finance Manager'],
            ['id' => 17, 'job_title' => 'Account Manager'],
            ['id' => 18, 'job_title' => 'Business Development Manager'],
            ['id' => 19, 'job_title' => 'Customer Service Manager'],
            ['id' => 20, 'job_title' => 'Team Leader'],
            ['id' => 21, 'job_title' => 'Supervisor'],
            ['id' => 22, 'job_title' => 'Consultant'],
            ['id' => 23, 'job_title' => 'Analyst'],
            ['id' => 24, 'job_title' => 'Software Engineer'],
            ['id' => 25, 'job_title' => 'Data Scientist'],
            ['id' => 26, 'job_title' => 'Designer'],
            ['id' => 27, 'job_title' => 'Developer'],
            ['id' => 28, 'job_title' => 'Technician'],
            ['id' => 29, 'job_title' => 'Specialist'],
            ['id' => 30, 'job_title' => 'Administrative Assistant'],
            ['id' => 31, 'job_title' => 'Sales Representative'],
            ['id' => 32, 'job_title' => 'Account Executive'],
            ['id' => 33, 'job_title' => 'Customer Support Specialist'],
            ['id' => 34, 'job_title' => 'Marketing Specialist'],
            ['id' => 35, 'job_title' => 'Researcher'],
            ['id' => 36, 'job_title' => 'Intern'],
            ['id' => 37, 'job_title' => 'Other'],
        ];

        DB::table('contact_job_titles')->insert($contact_job_titles);
    }
}
