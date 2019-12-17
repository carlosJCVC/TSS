<?php

use Illuminate\Database\Seeder;
use App\models\SalePrice;

class SalesSeeder extends Seeder
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
                'sales_price' => 10,
                'number_days' => 20,
                'probability' => 0.15,
                'accumulate_probability' => 0.15
            ],
            [
                'product_id' => 1,
                'sales_price' => 12,
                'number_days' => 30,
                'probability' => 0.23,
                'accumulate_probability' => 0.38
            ],
            [
                'product_id' => 1,
                'sales_price' => 14,
                'number_days' => 40,
                'probability' => 0.31,
                'accumulate_probability' => 0.68
            ],
            [
                'product_id' => 1,
                'sales_price' => 16,
                'number_days' => 30,
                'probability' => 0.23,
                'accumulate_probability' => 0.92
            ],
            [
                'product_id' => 1,
                'sales_price' => 18,
                'number_days' => 10,
                'probability' => 0.08,
                'accumulate_probability' => 1.00
            ],
        ];


        foreach ($items as $item) {
            $sale = SalePrice::create($item);
        }
    }
}
