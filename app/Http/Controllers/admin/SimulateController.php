<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Product;
use DB;

class SimulateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $sales_price = DB::table('sales_price')->where('product_id', $product->id)->get();
        $purchases_price = DB::table('purchases_price')->where('product_id', $product->id)->get();
        $demands = DB::table('demands')->where('product_id', $product->id)->get();

        return View('admin.simulations.index2', [ 'product' => $product, 'sales' => $sales_price, 'purchases' => $purchases_price, 'demands' => $demands ]);
    }

    /**
     * Show the form for simulate a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function simulate(Product $product)
    {
        return View('admin.simulations.index', [ 'product' => $product, 'data' => []]);
    }
    
}
