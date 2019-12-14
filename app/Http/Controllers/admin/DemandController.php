<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Demand;
use App\models\Product;
use App\Http\Requests\DemandRequest;
use DB;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demands = DB::table('demands')->get();

        return View('admin.demands.index', [ 'demands' => $demands ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DemandRequest $request, Product $product)
    {
        $input = $request->all();
        $input['product_id'] = $product->id;

        $demand = new Demand($input);
        $demand->save();

        $this->updateDemands();

        return redirect(route('admin.products.simulate.index', $product->id))->with([ 'message' => 'Demanda creado exitosamente!', 'alert-type' => 'success' ]);
    }

    public function updateDemands() {
        $demands = Demand::all();
        $total = DB::table('demands')->sum('number_days');

        $accumulate = 0;
        foreach ($demands as $key => $item) {
            $item->probability = $item->number_days / $total;
            
            if ($key == 0) {
                $accumulate = $item->probability + 0;
            } else {
                $previous = DB::table('demands')->where('id', '<', $item->id)->orderBy('id','desc')->first();
                $accumulate = $item->probability + $previous->accumulate_probability;
            }

            $item->accumulate_probability = $accumulate;
            $item->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Demand $demand)
    {
        return response()->json($demand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demand $demand)
    {
        $demand->update($request->all());
        $demand->save();

        return redirect(route('admin.demands.index'))->with([ 'message' => 'Demanda creado exitosamente!', 'alert-type' => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demand $demand)
    {
        $demand->delete();

        return redirect(route('admin.demands.index'))->with([ 'message' => 'Demanda eliminado exitosamente!', 'alert-type' => 'success' ]);
    }
}
