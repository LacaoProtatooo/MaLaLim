<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jewelry;

class ItemController extends Controller
{
    public function home(Request $request)
    {
        $search = $request->input('search');
        $query = Jewelry::with('prices');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $jewelry = $query->paginate(10);

        return response()->json($jewelry);
    }

    public function index()
    {
        $data = Jewelry::with('prices')->get();
        return view('home.home', compact('data'));
    }
}
