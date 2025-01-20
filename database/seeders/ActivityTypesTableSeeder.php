<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $activity_types = [
            ['id' => 1, 'type' => 'General Activity'],
            ['id' => 2, 'type' => 'Phone Call'],
            ['id' => 3, 'type' => 'In-person Meeting'],
            ['id' => 4, 'type' => 'Virtual Meeting'],
            ['id' => 5, 'type' => 'Email'],
            ['id' => 6, 'type' => 'Follow-up'],
            ['id' => 7, 'type' => 'Presentation'],
            ['id' => 8, 'type' => 'Product Demo'],
            ['id' => 9, 'type' => 'Negotiation'],
            ['id' => 10, 'type' => 'Administrative Task'],
            ['id' => 11, 'type' => 'Event'],
            ['id' => 12, 'type' => 'Training'],
            ['id' => 13, 'type' => 'Client Visit'],
            ['id' => 14, 'type' => 'Technical Support'],
            ['id' => 15, 'type' => 'Contract Review'],
            ['id' => 16, 'type' => 'Project Update'],
            ['id' => 17, 'type' => 'Satisfaction Survey'],
            ['id' => 18, 'type' => 'Networking'],
            ['id' => 19, 'type' => 'Discovery Call'],
            ['id' => 20, 'type' => 'Strategic Planning'],
        ];

        DB::table('activity_types')->insert($activity_types);
    }
}
