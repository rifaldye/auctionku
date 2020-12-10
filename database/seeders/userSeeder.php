<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('users')->insert([
          'fname' => 'admin',
          'lname' => 'admin',
          'username' => 'admin',
          'email' => 'admin@admin.com',
          'tanggal_lahir' => '10-10-2001',
          'telp' => '021',
          'role_id' => '3',
          'password' => 'admin123',
      ]);
    }
}
