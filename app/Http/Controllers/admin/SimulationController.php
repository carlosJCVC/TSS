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
        $benefits = DB::table('simulation_data')->where('product_id', $product->id)->pluck('benefits')->toArray();
        $desv_stant = $this->stats_standard_deviation ( $benefits );
        $average = DB::table('simulation_data')->where('product_id', $product->id)->avg('benefits');
        $interval = ($desv_stant/sqrt($request->number_runs))*1.96;
        
        $results = [
            'num' => $request->compare_value,
            'benefits' => $average,
            'desvestp' => $desv_stant,
            'interval_confianza' => $interval,
            'max' => $average+$interval,
            'min' => $average-$interval,
        ];

        return View('admin.simulations.index', [ 'product' => $product, 'data' => $data, 'results' => $results]);
    }

    function stats_standard_deviation(array $a, $sample = false) {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double) $val) - $mean;
            $carry += $d * $d;
        };
        if ($sample) {
           --$n;
        }
        return sqrt($carry / $n);
    }

    public function getDemandValue($product) {

        //$max = DB::table('demands')->max('accumulate_probability');
        //$min = DB::table('demands')->min('accumulate_probability');
        $demands = DB::table('demands')->where('product_id', $product->id)->get();

        $num = $this->getRandonNumber();

        $value = $this->getDemandClosest($demands, $num);
        
        return $value+1;
    }

    public function getSaleValue($product) {

        $sales = DB::table('sales_price')->where('product_id', $product->id)->get();
        
        $num = $this->getRandonNumber();

        $value = $this->getSaleClosest($sales, $num);
        
        return $value+1;
    }

    public function getPurchaseValue($product) {

        $purchases = DB::table('purchases_price')->where('product_id', $product->id)->get();

        $num = $this->getRandonNumber();

        $value = $this->getPurchaseClosest($purchases, $num);
        
        return $value+1;
    }

    public function getDemandClosest($numbers, $num)
    {
        $cercano = 0;
        $diff = 20000000;
        foreach ($numbers as $key => $value) {
            if ($value->accumulate_probability == $num) {
                return $value;
            } else {
                if (abs($value->accumulate_probability - $num) < $diff) {
                    $cercano = $value->sold_units;
                    $diff = abs($value->accumulate_probability - $num);
                }
            }
        }

        return $cercano;
    }

    public function getPurchaseClosest($numbers, $num)
    {
        $cercano = 0;
        $diff = 20000000;
        foreach ($numbers as $key => $value) {
            if ($value->accumulate_probability == $num) {
                return $value;
            } else {
                if (abs($value->accumulate_probability - $num) < $diff) {
                    $cercano = $value->purchases_price;
                    $diff = abs($value->accumulate_probability - $num);
                }
            }
        }

        return $cercano;
    }

    public function getSaleClosest($numbers, $num) {
        $cercano = 0;
        $diff = 20000000;
        foreach ($numbers as $key => $value) {
            if ($value->accumulate_probability == $num) {
                return $value;
            } else {
                if (abs($value->accumulate_probability - $num) < $diff) {
                    $cercano = $value->sales_price;
                    $diff = abs($value->accumulate_probability - $num);
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
