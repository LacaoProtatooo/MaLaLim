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

        return view('home.home');
    }

    public function description($id)
    {
        // Retrieve item details based on $id
        $item = Jewelry::with(['prices', 'classification'])->find($id); // Assuming you have an Item model
        // dd($item);
        if ($item) {
            return response()->json([
                'success' => true,
                'data' => $item
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Item not found'
            ], 404);
        }
    }

}
