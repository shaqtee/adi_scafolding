<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileProvince = file_get_contents(base_path('/database/province.json'));
        $dataProvince = json_decode($fileProvince, true);
        Province::insert($dataProvince);
    }
}
