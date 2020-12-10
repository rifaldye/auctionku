<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class kurirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('kurirs')->insert([
          'nama' => 'jne',
          'logo' => 'jne.png',
      ]);
      \DB::table('kurirs')->insert([
          'nama' => 'pos',
          'logo' => 'pos.png',
      ]);
      \DB::table('kurirs')->insert([
          'nama' => 'tiki',
          'logo' => 'tiki.png',
      ]);
      \DB::table('kurirs')->insert([
          'nama' => 'wahana',
          'logo' => 'wahana.png',
      ]);
      \DB::table('kurirs')->insert([
          'nama' => 'jnt',
          'logo' => 'jnt.png',
      ]);
      \DB::table('kurirs')->insert([
          'nama' => 'sicepat',
          'logo' => 'sicepat.png',
      ]);
    }
}
