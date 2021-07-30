<?php

namespace Database\Seeders;

use App\Models\Courier;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Courier::insert([
            [
                'code' => 'jne',
                'title' => 'Jalur Nugraha Extra Courier'
            ],
            [
                'code' => 'pos',
                'title' => 'POS Indonesia'
            ],
            [
                'code' => 'tiki',
                'title' => 'Citra Van Titipan Kipat'
            ]

        ]);
    }
}
