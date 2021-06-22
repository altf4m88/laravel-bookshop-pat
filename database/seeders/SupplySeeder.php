<?php

namespace Database\Seeders;

use App\Models\Distributor;
use App\Models\Supply;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SupplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supply::factory()->count(20)->create();
    }
}
