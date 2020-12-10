<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class citySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $json = file_get_contents(storage_path('city.json'));
      $objs = json_decode($json,true);
      foreach ($objs['rajaongkir']['results'] as $row) {
        \DB::table('kotas')->insert([
          'provinsi_id'=>$row['provinsi_id'],
          'tipe'=>$row['type'],
          'nama'=>$row['nama_kota'],
          'pos'=>$row['postal_code']
        ]);
      }
    }
}
