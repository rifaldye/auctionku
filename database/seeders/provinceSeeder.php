<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class provinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $json = file_get_contents(storage_path('province.json'));
      $objs = json_decode($json,true);
      foreach ($objs['rajaongkir']['results'] as $row) {
        \DB::table('provinsis')->insert([
          'nama'=>$row['provinsi']
        ]);
      }
    }
}
