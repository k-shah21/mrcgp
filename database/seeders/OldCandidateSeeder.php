<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OldCandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::table('old_candidates')->insert([
            [
                'candidate_id' => '1234567',
                'name' => 'Alice Smith',
                'passportNumber' => 'P1234567',
                'usualForename' => 'Alice',
                'lastName' => 'Smith',
                'email' => 'alice@example.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'candidate_id' => '7654321',
                'name' => 'Bob Jones',
                'passportNumber' => 'P7654321',
                'usualForename' => 'Bob',
                'lastName' => 'Jones',
                'email' => 'bob@example.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'candidate_id' => '9999999',
                'name' => 'Charlie Brown',
                'passportNumber' => 'P9999999',
                'usualForename' => 'Charlie',
                'lastName' => 'Brown',
                'email' => 'charlie@example.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
