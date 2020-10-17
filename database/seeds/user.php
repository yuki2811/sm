<?php

use Illuminate\Database\Seeder;

class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('roles')->insert([
        	'name'=>Str::random(10),
        	'description'=>Str::random(10),
        ]);
         DB::table('permissions')->insert([
            'name'=>Str::random(10),
            'description'=>Str::random(10),
        ]);
    }
}
