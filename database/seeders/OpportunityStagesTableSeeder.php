<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpportunityStagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $opportunity_stages = [
            ['id' => 1, 'stage' => 'Prospecting', 'probability' => 10],
            ['id' => 2, 'stage' => 'Qualification', 'probability' => 30],
            ['id' => 3, 'stage' => 'Needs Analysis', 'probability' => 50],
            ['id' => 4, 'stage' => 'Proposal', 'probability' => 70],
            ['id' => 5, 'stage' => 'Negotiation', 'probability' => 90],
            ['id' => 6, 'stage' => 'Closed Won', 'probability' => 100],
            ['id' => 7, 'stage' => 'Closed Lost', 'probability' => 0],
        ];

        DB::table('opportunity_stages')->insert($opportunity_stages);
    }
}
