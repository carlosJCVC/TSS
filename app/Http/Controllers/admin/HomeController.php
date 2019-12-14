<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Demand;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = [
            'users_count' => DB::table('users')->count(),
            'demands' => DB::table('demands')->sum('sold_units'),
            'sale_price_max' => DB::table('sales_price')->max('sales_price'),
            'sale_price_min' => DB::table('sales_price')->min('sales_price'),
            'purchase_price_max' => DB::table('purchases_price')->max('purchases_price'),
            'purchase_price_min' => DB::table('purchases_price')->max('purchases_price'),
            'products' => DB::table('products')->count()
        ];

        return View('admin.homepage', [ 'values' => $values ]);
    }

}
