<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\models\SimulationData;
use App\models\Product;

class SimulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        SimulationData::query()->truncate();
        for ($i=0; $i < $request->number_runs ; $i++) { 
            
            $demand_simulate = $this->getDemandValue($product);
            $sale_simulate = $this->getSaleValue($product);
            $purchase_simulate = $this->getPurchaseValue($product);
            
            $values = [
                'product_id' => $product->id,
                'demand' => $demand_simulate,
                'sale_price' => $sale_simulate,
                'purchase_price' => $purchase_simulate,
                'purchase_cost' => $purchase_simulate+1,

                'excess_cost' => $this->excess($request->compare_value, $demand_simulate, $purchase_simulate),
                'benefits' => $this->benefits($request->compare_value, $demand_simulate, $sale_simulate, $purchase_simulate, $this->excess(18, $demand_simulate, $purchase_simulate)),
                
                'excess_cost_18' => $this->excess(18, $demand_simulate, $purchase_simulate),
                'benefits_18' => $this->benefits(18, $demand_simulate, $sale_simulate, $purchase_simulate, $this->excess(18, $demand_simulate, $purchase_simulate)),
                'excess_cost_19' => $this->excess(19, $demand_simulate, $purchase_simulate),
                'benefits_19' => $this->benefits(19, $demand_simulate, $sale_simulate, $purchase_simulate, $this->excess(19, $demand_simulate, $purchase_simulate)),
                'excess_cost_20' => $this->excess(20, $demand_simulate, $purchase_simulate),
                'benefits_20' => $this->benefits(20, $demand_simulate, $sale_simulate, $purchase_simulate, $this->excess(20, $demand_simulate, $purchase_simulate)),
                'excess_cost_21' => $this->excess(21, $demand_simulate, $purchase_simulate),
                'benefits_21' => $this->benefits(21, $demand_simulate, $sale_simulate, $purchase_simulate, $this->excess(21, $demand_simulate, $purchase_simulate)),
                'excess_cost_22' => $this->excess(22, $demand_simulate, $purchase_simulate),
                'benefits_22' => $this->benefits(22, $demand_simulate, $sale_simulate, $purchase_simulate, $this->excess(22, $demand_simulate, $purchase_simulate)),
                'excess_cost_23' => $this->excess(23, $demand_simulate, $purchase_simulate),
                'benefits_23' => $this->benefits(23, $demand_simulate, $sale_simulate, $purchase_simulate, $this->excess(23, $demand_simulate, $purchase_simulate)),
                'excess_cost_24' => $this->excess(24, $demand_simulate, $purchase_simulate),
                'benefits_24' => $this->benefits(24, $demand_simulate, $sale_simulate, $purchase_simulate, $this->excess(24, $demand_simulate, $purchase_simulate)),
                'excess_cost_25' => $this->excess(25, $demand_simulate, $purchase_simulate),
                'benefits_25' => $this->benefits(25, $demand_simulate, $sale_simulate, $purchase_simulate, $this->excess(25, $demand_simulate, $purchase_simulate)),
                'excess_cost_26' => $this->excess(26, $demand_simulate, $purchase_simulate),
                'benefits_26' => $this->benefits(26, $demand_simulate, $sale_simulate, $purchase_simulate, $this->excess(26, $demand_simulate, $purchase_simulate)),
            ];
            
            $data = new SimulationData($values);
            $data->save();
        }

        $data = DB::table('simulation_data')->where('product_id', $product->id)->get();

        $results = [
            'benefits' => DB::table('simulation_data')->where('product_id', $product->id)->avg('benefits'),
        ];

        return View('admin.simulations.index', [ 'product' => $product, 'data' => $data]);
    }

    public function getDemandValue($product) {

        //$max = DB::table('demands')->max('accumulate_probability');
        //$min = DB::table('demands')->min('accumulate_probability');
        $demands = DB::table('demands')->where('product_id', $product->id)->pluck('sold_units', 'accumulate_probability');
        
        $num = $this->getRandonNumber();

        $value = $this->getDemandClosest($demands, $num);
        
        return $value+1;
    }

    public function getSaleValue($product) {

        $sales = DB::table('sales_price')->where('product_id', $product->id)->pluck('sales_price', 'accumulate_probability');
        
        $num = $this->getRandonNumber();

        $value = $this->getDemandClosest($sales, $num);
        
        return $value+1;
    }

    public function getPurchaseValue($product) {

        $purchases = DB::table('purchases_price')->where('product_id', $product->id)->pluck('purchases_price', 'accumulate_probability');

        $num = $this->getRandonNumber();

        $value = $this->getDemandClosest($purchases, $num);
        
        return $value+1;
    }

    public function getDemandClosest($numbers, $num)
    {
        $cercano = 0;
        $diff = 20000000;
        
        foreach ($numbers as $key => $value) {
            if ($key == $num) {
                return $value;
            } else {
                if (abs($key - $num) < $diff) {
                    $cercano = $value;
                    $diff = abs($key - $num);
                }
            }
        }

        return $cercano;
    }

    public function getRandonNumber(){
        return mt_rand(0*1000000,1*1000000)/1000000;
    }

    public function excess($num, $demand, $price) {
        if ($num > $demand) {
            return ($num-$demand)*$price;
        } else {
            return 0;
        }
    }

    public function benefits($num, $demand, $sale_price, $purchase_price, $excess) {
        if ($num <= $demand) {
            return ($num * $sale_price) - ($num * $purchase_price);
        } else {
            return ($demand * $sale_price) - ($demand * $purchase_price) - $excess;
        }
    }
}
