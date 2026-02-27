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
                'name' => 'Khubaib Shah',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'candidate_id' => '7654321',
                'name' => 'John Doe',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'candidate_id' => '9999999',
                'name' => 'Charlie Brown',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
