<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientIndustriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $client_industries = [
            ['id' => 1, 'industry' => 'Technology'],
            ['id' => 2, 'industry' => 'Healthcare'],
            ['id' => 3, 'industry' => 'Finance'],
            ['id' => 4, 'industry' => 'Education'],
            ['id' => 5, 'industry' => 'Construction'],
            ['id' => 6, 'industry' => 'Manufacturing'],
            ['id' => 7, 'industry' => 'Retail'],
            ['id' => 8, 'industry' => 'Energy'],
            ['id' => 9, 'industry' => 'Logistics and Transportation'],
            ['id' => 10, 'industry' => 'Media and Entertainment'],
            ['id' => 11, 'industry' => 'Real Estate'],
            ['id' => 12, 'industry' => 'Food and Beverage'],
            ['id' => 13, 'industry' => 'Agriculture'],
            ['id' => 14, 'industry' => 'Consulting'],
            ['id' => 15, 'industry' => 'Insurance'],
            ['id' => 16, 'industry' => 'Automotive'],
            ['id' => 17, 'industry' => 'Tourism and Hospitality'],
            ['id' => 18, 'industry' => 'Legal Services'],
            ['id' => 19, 'industry' => 'Telecommunications'],
            ['id' => 20, 'industry' => 'Other'],
        ];

        DB::table('client_industries')->insert($client_industries);
    }
}
