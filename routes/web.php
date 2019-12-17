<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.', 'namespace' => 'admin'], function () {
    Route::get('/', [
        'as' => 'admin.home',
        'uses' => 'HomeController@index'
    ]);

        //----------- PRODUCTS ------------//
    Route::get('products', [
        'as' => 'products.index',
        'uses' => 'ProductController@index',
    ]);
    Route::get('products/show/{product}', [
        'as' => 'products.show',
        'uses' => 'ProductController@show',
    ]);
    Route::post('products/store', [
        'as' => 'products.store',
        'uses' => 'ProductController@store',
    ]);
    Route::put('products/{product}', [
        'as' => 'products.update',
        'uses' => 'ProductController@update',
    ]);
    Route::patch('products/{product}', [
        'as' => 'products.update',
        'uses' => 'ProductController@update',
    ]);
    Route::delete('products/{product}', [
        'as' => 'products.destroy',
        'uses' => 'ProductController@destroy',
    ]);


    //------------ Simular ------------//
    Route::get('product/{product}/simulation', [
        'as' => 'products.simulate.index',
        'uses' => 'SimulateController@index',
    ]);
    Route::get('simulation/{product}', [
        'as' => 'simulate.data',
        'uses' => 'SimulateController@simulate',
    ]);
    Route::get('simulation/{product}/store', [
        'as' => 'simulate.data.store',
        'uses' => 'SimulationController@index',
    ]);

    //----------- DEMANDS ------------//
    Route::get('demands', [
        'as' => 'demands.index',
        'uses' => 'DemandController@index',
    ]);
    Route::get('demands/show/{demand}', [
        'as' => 'demands.show',
        'uses' => 'DemandController@show',
    ]);
    Route::post('demands/{product}/store', [
        'as' => 'demands.store',
        'uses' => 'DemandController@store',
    ]);
    Route::put('demands/{demand}', [
        'as' => 'demands.update',
        'uses' => 'DemandController@update',
    ]);
    Route::patch('demands/{demand}', [
        'as' => 'demands.update',
        'uses' => 'DemandController@update',
    ]);
    Route::delete('demands/{demand}', [
        'as' => 'demands.destroy',
        'uses' => 'DemandController@destroy',
    ]);

    //----------- SALES ------------//
    Route::get('sales_price', [
        'as' => 'sales_price.index',
        'uses' => 'SalePriceController@index',
    ]);
    Route::get('sales_price/json', [
        'as' => 'sales_price.json',
        'uses' => 'SalePriceController@json',
    ]);
    Route::get('sales_price/show/{sale_price}', [
        'as' => 'sales_price.show',
        'uses' => 'SalePriceController@show',
    ]);
    Route::post('sales_price/{product}/store', [
        'as' => 'sales_price.store',
        'uses' => 'SalePriceController@store',
    ]);
    Route::put('sales_price/{sale_price}', [
        'as' => 'sales_price.update',
        'uses' => 'SalePriceController@update',
    ]);
    Route::patch('sales_price/{sale_price}', [
        'as' => 'sales_price.update',
        'uses' => 'SalePriceController@update',
    ]);
    Route::delete('sales_price/{sale_price}', [
        'as' => 'sales_price.destroy',
        'uses' => 'SalePriceController@destroy',
    ]);

    //----------- PURCHASE ------------//
    Route::get('purchases_price', [
        'as' => 'purchases_price.index',
        'uses' => 'PurchasePriceController@index',
    ]);
    Route::get('purchases_price/show/{purchase_price}', [
        'as' => 'purchases_price.show',
        'uses' => 'PurchasePriceController@show',
    ]);
    Route::post('purchases_price/{product}/store', [
        'as' => 'purchases_price.store',
        'uses' => 'PurchasePriceController@store',
    ]);
    Route::put('purchases_price/{purchase_price}', [
        'as' => 'purchases_price.update',
        'uses' => 'PurchasePriceController@update',
    ]);
    Route::patch('purchases_price/{purchase_price}', [
        'as' => 'purchases_price.update',
        'uses' => 'PurchasePriceController@update',
    ]);
    Route::delete('purchases_price/{purchase_price}', [
        'as' => 'purchases_price.destroy',
        'uses' => 'PurchasePriceController@destroy',
    ]);

    
    //----------- Simulation ------------//
    Route::get('simulation', [
        'as' => 'simulation.index',
        'uses' => 'SimulationController@index',
    ]);

    Route::get('simulation/{product}/default', [
        'as' => 'simulation.default',
        'uses' => 'SimulationDefaultController@index',
    ]);
});
