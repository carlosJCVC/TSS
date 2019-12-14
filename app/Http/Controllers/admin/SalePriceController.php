<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SalePrice;
use App\models\Product;
use DB;
use App\Http\Requests\SaleRequest;

class SalePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales_price = DB::table('sales_price')->get();

        return View('admin.sales_price.index', [ 'sales' => $sales_price ]);
    }

    /**
     * Display a listing of the resource in json.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        $sales_price = DB::table('sales_price')->get();

        return response()->json($sales_price);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request, Product $product)
    {
        $input = $request->all();
        $input['product_id'] = $product->id;

        $sale_price = new SalePrice($input);
        $sale_price->save();

        $this->updateSales();

        return redirect(route('admin.products.simulate.index', $product->id))->with([ 'message' => 'Precio de Venta creado exitosamente!', 'alert-type' => 'success' ]);
    }

    public function updateSales() {
        $sales = SalePrice::all();
        $total = DB::table('sales_price')->sum('number_days');

        $accumulate = 0;
        foreach ($sales as $key => $item) {
            $item->probability = $item->number_days / $total;
            
            if ($key == 0) {
                $accumulate = $item->probability + 0;
            } else {
                $previous = DB::table('sales_price')->where('id', '<', $item->id)->orderBy('id','desc')->first();
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
    public function show(SalePrice $sale_price)
    {
        return response()->json($sale_price);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalePrice $sale_price)
    {
        $sale_price->update($request->all());
        $sale_price->save();

        return redirect(route('admin.sales_price.index'))->with([ 'message' => 'Precio de Venta actualizado exitosamente!', 'alert-type' => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalePrice $sale_price)
    {
        $sale_price->delete();

        return redirect(route('admin.sales_price.index'))->with([ 'message' => 'Precio de Venta compra eliminado exitosamente!', 'alert-type' => 'success' ]);
    }
}
