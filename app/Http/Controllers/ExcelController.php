<?php

namespace App\Http\Controllers;

use App\Imports\CourierImport;
use App\Imports\PromoImport;

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

    public function importPromo(Request $request){
        $request->validate([
            'promo_file' => 'required|mimes:xlsx,csv',
        ]);
    
        Excel::import(new PromoImport, $request->file('promo_file'));
    
        return response()->json(['success' => 'Promos imported successfully!']);
    }



}
