<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_buku' => $this->faker->unique()->numerify('BK#######'),
            'judul' => $this->faker->word,
            'noisbn' => $this->faker->isbn13,
            'penulis' => $this->faker->name,
            'penerbit' => $this->faker->company,
            'tahun' => $this->faker->numberBetween(1900, 2020),
            'stok' => $this->faker->numberBetween(0, 200),
            'harga_pokok' => $this->faker->numberBetween(10000, 20000),
            'harga_jual' => $this->faker->numberBetween(22000, 30000),
            'ppn' => 10,
            'diskon' => $this->faker->numberBetween(1, 50),
            'created_at' => $this->faker->dateTime('now', 'UTC'),
            'updated_at' => $this->faker->dateTime('now', 'UTC'),
        ];
    }
}
