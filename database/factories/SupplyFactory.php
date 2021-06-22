<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Distributor;
use App\Models\Supply;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_distributor' => Distributor::factory()->create()->id_distributor,
            'id_buku' => Book::factory()->create()->id_buku,
            'jumlah' => $this->faker->numberBetween(1, 50),
            'tanggal' => $this->faker->dateTime('now', 'UTC'),
        ];
    }
}
