<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\PurchasePrice;
use DB;
use App\Http\Requests\PurchaseRequest;
use App\models\Product;

class PurchasePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases_price = DB::table('purchases_price')->get();

        return View('admin.purchases_price.index', [ 'purchases' => $purchases_price ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request, Product $product)
    {
        $input = $request->all();
        $input['product_id'] = $product->id;

        $purchase_price = new PurchasePrice($input);
        $purchase_price->save();

        $this->updatePurchases();

        return redirect(route('admin.products.simulate.index', $product->id))->with([ 'message' => 'Precio de Venta creado exitosamente!', 'alert-type' => 'success' ]);
    }

    public function updatePurchases() {
        $purchases = PurchasePrice::all();
        $total = DB::table('purchases_price')->sum('number_days');

        $accumulate = 0;
        foreach ($purchases as $key => $item) {
            $item->probability = $item->number_days / $total;
            
            if ($key == 0) {
                $accumulate = $item->probability + 0;
            } else {
                $previous = DB::table('purchases_price')->where('id', '<', $item->id)->orderBy('id','desc')->first();
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
    public function show(PurchasePrice $purchase_price)
    {
        return response()->json($purchase_price);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchasePrice $purchase_price)
    {
        $purchase_price->update($request->all());
        $purchase_price->save();

        return redirect(route('admin.purchases_price.index'))->with([ 'message' => 'Precio de Compra actualizado exitosamente!', 'alert-type' => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchasePrice $purchase_price)
    {
        $purchase_price->delete();

        return redirect(route('admin.purchases_price.index'))->with([ 'message' => 'Precio de compra eliminado exitosamente!', 'alert-type' => 'success' ]);
    }
}
