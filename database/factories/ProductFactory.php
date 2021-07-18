<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_produk' => $this->faker->company(),
            'harga' => 100000,
            'deskripsi' => $this->faker->text(),
            'kategori' => 'minuman',
            'foto' => $this->faker->image()
        ];
    }
}
