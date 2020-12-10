<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
          citySeeder::class,
        ]);
        $this->call([
          kurirSeeder::class,
        ]);
        $this->call([
          provinceSeeder::class,
        ]);
        $this->call([
          roleSeeder::class,
        ]);
        $this->call([
          userSeeder::class,
        ]);
    }
}
