<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(DemandSeeder::class);
        $this->call(SalesSeeder::class);
        $this->call(purchasesSeeder::class);
    }
}
