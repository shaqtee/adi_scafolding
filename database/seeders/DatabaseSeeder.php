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
        //\App\Models\User::factory(5)->create();
        //$this->call(LaratrustSeeder::class);
        //$this->call(ProductSeeder::class);

        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CourierSeeder::class);
    }
}
