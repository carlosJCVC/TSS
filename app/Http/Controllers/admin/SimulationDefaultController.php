<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\models\SimulationData;
use App\models\Product;

class SimulationDefaultController extends Controller
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
            $purchase_cost = $purchase_simulate+1;

            $values = [
                'product_id' => $product->id,
                'demand' => $demand_simulate,
                'sale_price' => $sale_simulate,
                'purchase_price' => $purchase_simulate,
                'purchase_cost' => $purchase_cost,

                'excess_cost' => $this->excess($request->compare_value, $demand_simulate, $purchase_simulate),
                'benefits' => $this->benefits($request->compare_value, $demand_simulate, $sale_simulate, $purchase_cost, $this->excess(18, $demand_simulate, $purchase_cost)),

                'excess_cost_18' => $this->excess(18, $demand_simulate, $purchase_cost),
                'benefits_18' => $this->benefits(18, $demand_simulate, $sale_simulate, $purchase_cost, $this->excess(18, $demand_simulate, $purchase_cost)),
                'excess_cost_19' => $this->excess(19, $demand_simulate, $purchase_cost),
                'benefits_19' => $this->benefits(19, $demand_simulate, $sale_simulate, $purchase_cost, $this->excess(19, $demand_simulate, $purchase_cost)),
                'excess_cost_20' => $this->excess(20, $demand_simulate, $purchase_cost),
                'benefits_20' => $this->benefits(20, $demand_simulate, $sale_simulate, $purchase_cost, $this->excess(20, $demand_simulate, $purchase_cost)),
                'excess_cost_21' => $this->excess(21, $demand_simulate, $purchase_cost),
                'benefits_21' => $this->benefits(21, $demand_simulate, $sale_simulate, $purchase_cost, $this->excess(21, $demand_simulate, $purchase_cost)),
                'excess_cost_22' => $this->excess(22, $demand_simulate, $purchase_cost),
                'benefits_22' => $this->benefits(22, $demand_simulate, $sale_simulate, $purchase_cost, $this->excess(22, $demand_simulate, $purchase_cost)),
                'excess_cost_23' => $this->excess(23, $demand_simulate, $purchase_cost),
                'benefits_23' => $this->benefits(23, $demand_simulate, $sale_simulate, $purchase_cost, $this->excess(23, $demand_simulate, $purchase_cost)),
                'excess_cost_24' => $this->excess(24, $demand_simulate, $purchase_cost),
                'benefits_24' => $this->benefits(24, $demand_simulate, $sale_simulate, $purchase_cost, $this->excess(24, $demand_simulate, $purchase_cost)),
                'excess_cost_25' => $this->excess(25, $demand_simulate, $purchase_cost),
                'benefits_25' => $this->benefits(25, $demand_simulate, $sale_simulate, $purchase_cost, $this->excess(25, $demand_simulate, $purchase_cost)),
                'excess_cost_26' => $this->excess(26, $demand_simulate, $purchase_cost),
                'benefits_26' => $this->benefits(26, $demand_simulate, $sale_simulate, $purchase_cost, $this->excess(26, $demand_simulate, $purchase_cost)),
            ];

            $data = new SimulationData($values);
            $data->save();
        }

        $data = DB::table('simulation_data')->where('product_id', $product->id)->get();

        $benefits_18 = DB::table('simulation_data')->where('product_id', $product->id)->pluck('benefits_18')->toArray();
        $desv_stant_18 = $this->stats_standard_deviation ( $benefits_18 );
        $average_18 = DB::table('simulation_data')->where('product_id', $product->id)->avg('benefits_18');
        $interval_18 = ($desv_stant_18/sqrt($request->number_runs))*1.96;
        
        $results = $this->getResults($product, $request->number_runs);

        return View('admin.simulations.default', [ 'product' => $product, 'data' => $data, 'results' => $results]);
    }

    public function getAverage($product, $num) {
        return DB::table('simulation_data')->where('product_id', $product->id)->avg('benefits_'.$num);
    }

    public function getAverageCost($product, $num) {
        return DB::table('simulation_data')->where('product_id', $product->id)->avg('excess_cost_'.$num);
    }

    public function getInterval($product, $num, $run) {
        $benefits = DB::table('simulation_data')->where('product_id', $product->id)->pluck('benefits_'.$num)->toArray();
        $desv_stant = $this->stats_standard_deviation ( $benefits );

        return ($desv_stant/sqrt($run))*1.96;
    }

    public function getIntervalCost($product, $num, $run) {
        $costs = DB::table('simulation_data')->where('product_id', $product->id)->pluck('excess_cost_'.$num)->toArray();
        $desv_stant = $this->stats_standard_deviation ( $costs );

        return ($desv_stant/sqrt($run))*1.96;
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
        //dd([$cercano, $num]);

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

    public function getResults($product, $number_runs) {
        $res = [
            'nums' => [18,19,20,21,22,23,24,25,26],
            'max_18' => $this->getAverage($product, 18)+$this->getInterval($product, 18, $number_runs),
            'min_18' => $this->getAverage($product, 18)-$this->getInterval($product, 18, $number_runs),
            'costmax_18' => $this->getAverageCost($product, 18)+$this->getIntervalCost($product, 18, $number_runs),
            'costmin_18' => $this->getAverageCost($product, 18)-$this->getIntervalCost($product, 18, $number_runs),
            'max_19' => $this->getAverage($product, 19)+$this->getInterval($product, 19, $number_runs),
            'min_19' => $this->getAverage($product, 19)-$this->getInterval($product, 19, $number_runs),
            'costmax_19' => $this->getAverageCost($product, 19)+$this->getIntervalCost($product, 19, $number_runs),
            'costmin_19' => $this->getAverageCost($product, 19)-$this->getIntervalCost($product, 19, $number_runs),
            'max_20' => $this->getAverage($product, 20)+$this->getInterval($product, 20, $number_runs),
            'min_20' => $this->getAverage($product, 20)-$this->getInterval($product, 20, $number_runs),
            'costmax_20' => $this->getAverageCost($product, 20)+$this->getIntervalCost($product, 20, $number_runs),
            'costmin_20' => $this->getAverageCost($product, 20)-$this->getIntervalCost($product, 20, $number_runs),
            'max_21' => $this->getAverage($product, 21)+$this->getInterval($product, 21, $number_runs),
            'min_21' => $this->getAverage($product, 21)-$this->getInterval($product, 21, $number_runs),
            'costmax_21' => $this->getAverageCost($product, 21)+$this->getIntervalCost($product, 21, $number_runs),
            'costmin_21' => $this->getAverageCost($product, 21)-$this->getIntervalCost($product, 21, $number_runs),
            'max_22' => $this->getAverage($product, 22)+$this->getInterval($product, 22, $number_runs),
            'min_22' => $this->getAverage($product, 22)-$this->getInterval($product, 22, $number_runs),
            'costmax_22' => $this->getAverageCost($product, 22)+$this->getIntervalCost($product, 22, $number_runs),
            'costmin_22' => $this->getAverageCost($product, 22)-$this->getIntervalCost($product, 22, $number_runs),
            'max_23' => $this->getAverage($product, 23)+$this->getInterval($product, 23, $number_runs),
            'min_23' => $this->getAverage($product, 23)-$this->getInterval($product, 23, $number_runs),
            'costmax_23' => $this->getAverageCost($product, 23)+$this->getIntervalCost($product, 23, $number_runs),
            'costmin_23' => $this->getAverageCost($product, 23)-$this->getIntervalCost($product, 23, $number_runs),
            'max_24' => $this->getAverage($product, 24)+$this->getInterval($product, 24, $number_runs),
            'min_24' => $this->getAverage($product, 24)-$this->getInterval($product, 24, $number_runs),
            'costmax_24' => $this->getAverageCost($product, 24)+$this->getIntervalCost($product, 24, $number_runs),
            'costmin_24' => $this->getAverageCost($product, 24)-$this->getIntervalCost($product, 24, $number_runs),
            'max_25' => $this->getAverage($product, 25)+$this->getInterval($product, 25, $number_runs),
            'min_25' => $this->getAverage($product, 25)-$this->getInterval($product, 25, $number_runs),
            'costmax_25' => $this->getAverageCost($product, 25)+$this->getIntervalCost($product, 25, $number_runs),
            'costmin_25' => $this->getAverageCost($product, 25)-$this->getIntervalCost($product, 25, $number_runs),
            'max_26' => $this->getAverage($product, 26)+$this->getInterval($product, 26, $number_runs),
            'min_26' => $this->getAverage($product, 26)-$this->getInterval($product, 26, $number_runs),
            'costmax_26' => $this->getAverageCost($product, 26)+$this->getIntervalCost($product, 26, $number_runs),
            'costmin_26' => $this->getAverageCost($product, 26)-$this->getIntervalCost($product, 26, $number_runs),
        ];

        return $res;
    }
}
