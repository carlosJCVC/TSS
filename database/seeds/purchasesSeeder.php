<?php

use Illuminate\Database\Seeder;
use App\models\PurchasePrice;

class purchasesSeeder extends Seeder
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
                'purchases_price' => 5,
                'number_days' => 15,
                'probability' => 0.14,
                'accumulate_probability' => 0.14
            ],
            [
                'product_id' => 1,
                'purchases_price' => 7,
                'number_days' => 25,
                'probability' => 0.23,
                'accumulate_probability' => 0.36
            ],
            [
                'product_id' => 1,
                'purchases_price' => 9,
                'number_days' => 35,
                'probability' => 0.32,
                'accumulate_probability' => 0.68
            ],
            [
                'product_id' => 1,
                'purchases_price' => 11,
                'number_days' => 25,
                'probability' => 0.23,
                'accumulate_probability' => 0.91
            ],
            [
                'product_id' => 1,
                'purchases_price' => 17,
                'number_days' => 10,
                'probability' => 0.09,
                'accumulate_probability' => 1.00
            ],
        ];


        foreach ($items as $item) {
            $sale = PurchasePrice::create($item);
        }
    }
}
