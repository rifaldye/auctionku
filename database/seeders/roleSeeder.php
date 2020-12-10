<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         \DB::table('roles')->insert([
             'role' => '0',
             'role_name' => 'pembeli',
         ]);
         \DB::table('roles')->insert([
             'role' => '1',
             'role_name' => 'penjual',
         ]);
         \DB::table('roles')->insert([
             'role' => '2',
             'role_name' => 'admin',
         ]);
     }
}
