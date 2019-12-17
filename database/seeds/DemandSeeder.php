<?php

use Illuminate\Database\Seeder;
use App\models\Demand;

class DemandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'product_id' => 1,
                'sold_units' => 20,
                'number_days' => 10,
                'probability' => 0.08,
                'accumulate_probability' => 0.08 
            ],
            [
                'product_id' => 1,
                'sold_units' => 21,
                'number_days' => 20,
                'probability' => 0.17,
                'accumulate_probability' => 0.25
            ],
            [
                'product_id' => 1,
                'sold_units' => 22,
                'number_days' => 30,
                'probability' => 0.25,
                'accumulate_probability' => 0.50
            ],
            [
                'product_id' => 1,
                'sold_units' => 23,
                'number_days' => 30,
                'probability' => 0.25,
                'accumulate_probability' => 0.75
            ],
            [
                'product_id' => 1,
                'sold_units' => 24,
                'number_days' => 20,
                'probability' => 0.17,
                'accumulate_probability' => 0.92
            ],
            [
                'product_id' => 1,
                'sold_units' => 25,
                'number_days' => 10,
                'probability' => 0.08,
                'accumulate_probability' => 1.00
            ],
        ];


        foreach ($items as $item) {
            $demand = Demand::create($item);
        }
    }
}
