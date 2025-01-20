<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $client_types = [
            ['id' => 1, 'type' => 'Company'],
            ['id' => 2, 'type' => 'Individual'],
            ['id' => 3, 'type' => 'Non-Profit Organization'],
            ['id' => 4, 'type' => 'Government Agency'],
            ['id' => 5, 'type' => 'Educational Institution'],
            ['id' => 6, 'type' => 'Distributor'],
            ['id' => 7, 'type' => 'Supplier'],
            ['id' => 8, 'type' => 'Partner'],
            ['id' => 9, 'type' => 'Investor'],
            ['id' => 10, 'type' => 'Other'],
        ];

        DB::table('client_types')->insert($client_types);
    }
}
