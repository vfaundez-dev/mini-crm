<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $client_status = [
            ['id' => 1, 'status' => 'Active'],
            ['id' => 2, 'status' => 'Inactive'],
            ['id' => 3, 'status' => 'Prospect'],
            ['id' => 4, 'status' => 'Pending'],
            ['id' => 5, 'status' => 'Lost'],
            ['id' => 6, 'status' => 'Other'],
        ];

        DB::table('client_status')->insert($client_status);
    }
}
