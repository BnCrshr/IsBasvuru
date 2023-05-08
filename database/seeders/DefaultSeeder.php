<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'KCTEK Admin',
            'email' => 'super@admin.com',
            'password' => '$2y$10$tyNYZaTLidiqbLerLSW9peetvpW4SQzHhXS1q0VyT91lo9sUo.i4a',
        ]);
    }
}
