<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jewelry;

class ItemController extends Controller
{
    public function home(){
        $jewel = Jewelry::with(['colors', 'materials', 'classifications'])->get();

        return view('home.home', compact('jewel'));
    }
}
