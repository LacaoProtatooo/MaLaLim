<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jewelry;
use App\Models\Stock;

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
        $item = Jewelry::with(['prices', 'classification', 'colors'])->find($id); // Assuming you have an Item model
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

    public function stonks(Request $request)
    {
        // dd($request->input('col'));
        $colID = $request->input('col');
        $IteID = $request->input('ite');

        $jewelry = Jewelry::find($IteID);


        if ($jewelry && $jewelry->colors()->where('color_id', $colID)->exists()) {

            $pivotRecord = $jewelry->colors()->wherePivot('color_id', $colID)->first();

            // dd($pivotRecord->pivot->id);
            $colorJewelryId = $pivotRecord->pivot->id;

            $stonks = Stock::where('color_jewelry_id', $colorJewelryId)->first();
            // dd($stonks);

            return response()->json([
                'success' => true,
                'data' => $stonks
            ]);

        } else {

            return response()->json(['message' => 'Record not found'], 404);
        }
    }

}
