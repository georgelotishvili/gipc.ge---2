<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederCleaner extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find and delete questions without answers
        DB::table('questions')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('answers')
                      ->whereRaw('answers.question_id = questions.id');
            })
            ->delete();
    }
}
