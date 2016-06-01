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
            'password' => bcrypt("password"),
            "admin" => 1,
            "created_at" => date("Y-m-d H:i:s"),
        ]);
            DB::table('users')->insert([
            'id' => 2,
            'name' => "cowie",
            'email' => 'cowie.augustsson@gmail.com',
            'password' => bcrypt("password"),
            "admin" => 0,
            "created_at" => date("Y-m-d H:i:s"),
        ]);
            DB::table('schemas')->insert([
            'id' => 1,
            'name' => "test schema",
            'user_id' => 1,
            "created_at" => date("Y-m-d H:i:s"),
        ]);
            DB::table('schemas')->insert([
   
            'name' => "another schema",
            'user_id' => 1,
            "created_at" => date("Y-m-d H:i:s"),
        ]);
            DB::table('schema_blocks')->insert([
   
            'name' => "remove sand from skeleton",
            'schema_id' => 1,
            "created_at" => date("Y-m-d H:i:s"),
        ]);


    }
}
