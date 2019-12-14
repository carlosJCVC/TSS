<?php

use Illuminate\Database\Seeder;
use App\models\Product;

class ProductsSeeder extends Seeder
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
                'name' => 'Naranjas',
            ],
            [
                'name' => 'Manzanas',
            ],
            [
                'name' => 'Papayas',
            ],
            [
                'name' => 'Ubas',
            ],
            [
                'name' => 'Limones',
            ],
            [
                'name' => 'Mangos',
            ],
            [
                'name' => 'Bananas',
            ],
            [
                'name' => 'Almendras',
            ],
            [
                'name' => 'Mandarinas',
            ],
            [
                'name' => 'Almendras',
            ],
        ];


        foreach ($items as $item) {
            $product = Product::create($item);
        }
    }
}
