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
                'purchases_price' => 10,
                'number_days' => 20,
                'probability' => 0.14,
                'accumulate_probability' => 0.14
            ],
            [
                'product_id' => 1,
                'purchases_price' => 12,
                'number_days' => 30,
                'probability' => 0.23,
                'accumulate_probability' => 0.36
            ],
            [
                'product_id' => 1,
                'purchases_price' => 14,
                'number_days' => 40,
                'probability' => 0.32,
                'accumulate_probability' => 0.68
            ],
            [
                'product_id' => 1,
                'purchases_price' => 16,
                'number_days' => 30,
                'probability' => 0.23,
                'accumulate_probability' => 0.91
            ],
            [
                'product_id' => 1,
                'purchases_price' => 18,
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
