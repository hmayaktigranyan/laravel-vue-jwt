<?php

use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->insert([
            'team_id' => '1',
            'first_name' => 'Player1',
            'last_name' => 'Lastname1',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('players')->insert([
            'team_id' => '1',
            'first_name' => 'Player2',
            'last_name' => 'Lastname2',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('players')->insert([
            'team_id' => '2',
            'first_name' => 'Player3',
            'last_name' => 'Lastname3',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
