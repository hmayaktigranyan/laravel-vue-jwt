<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'id' => 1,
            'name' => 'Team1',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('teams')->insert([
            'id' => 2,
            'name' => 'Team2',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('teams')->insert([
            'id' => 3,
            'name' => 'Team3',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
