<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jewelry;

class ItemController extends Controller
{
    public function home(){
        // $jewel = Jewelry::with(['colors', 'materials', 'classifications'])->get();
        // $jewel = Jewelry::with(['colorJewelries' => function ($query) {
        //     $query->with(['colors', 'stocks' => function ($query) {
                // $query->whereColumn('color_jewelry.color_id', 'colors.id')
                //       ->whereColumn('color_jewelry.jewelry_id', 'colors_jewelry.jewelry_id'); // Adjusted column name
        //     }])
        //     ->with(['colorJewelries.stocks']);
        // }])->get();
        

    }

    public function index(){
        $data = Jewelry::with('prices')->get();

        // return response()->json($data);
        return view('home.home', compact('data'));
    }

    public function searching(){

    }
}
