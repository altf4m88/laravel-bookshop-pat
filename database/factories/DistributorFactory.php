<?php

namespace Database\Factories;

use App\Models\Distributor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistributorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Distributor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_distributor' => $this->faker->name(),
            'alamat' => $this->faker->address,
            'telepon' => $this->faker->phoneNumber,
            'created_at' => $this->faker->dateTime('now', 'UTC'),
            'updated_at' => $this->faker->dateTime('now', 'UTC'),
        ];
    }
}
