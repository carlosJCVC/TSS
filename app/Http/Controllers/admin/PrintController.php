<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PrintController extends Controller
{
    public function index() {
        $data = DB::table('simulation_data')->get();

        $pdf = \PDF::loadView('admin.pdf.simulation', [ 'data' => $data ]);
        
        return $pdf->download('ejemplo.pdf');
    }
}
