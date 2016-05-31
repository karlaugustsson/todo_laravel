<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
            DB::table('users')->insert([
            'id' => 1,
            'name' => "karl",
            'email' => 'karl.augustsson@gmail.com',
            'password' => bcrypt("Herrbajskorv1"),
            "admin" => 1,
            "created_at" => date("Y-m-d H:i:s"),
        ]);


    }
}
