<?php

namespace App\Http\Controllers;

use App\Imports\CourierImport;
use App\Models\Courier;
use App\Models\Promo;
use App\Models\Jewelry;
use App\Models\Payment;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function importCourier(Request $request){
        $request->validate([
            'courier_file' => 'required|mimes:xlsx,csv',
        ]);
    
        Excel::import(new CourierImport, $request->file('courier_file'));
    
        return response()->json(['success' => 'Couriers imported successfully!']);
    }


    
}
