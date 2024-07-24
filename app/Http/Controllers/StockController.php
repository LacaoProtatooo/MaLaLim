<?php

namespace App\Http\Controllers;

use App\Models\ColorJewelry;
use App\Models\Color;
use App\Models\Stock;
use App\Models\Jewelry;

use Illuminate\Http\Request;

use Debugbar;



class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jewelries = Jewelry::all();
        $colors = Color::all();

        return response()->json([
            'jewelries' => $jewelries,
            'colors' => $colors
        ]);
    }

    /**
     *  Foreign Values needed to Get from my Color_Jewelry table
     *  jewelry_id = Jewelry
     *  color_id = Color
     *  
     *  Stock Table - color_jewelry_id
     */

    // CUSTOM
    public function dtpopulate(){
        $stocks = ColorJewelry::all();
        // Debugbar::info($stocks);

        foreach ($stocks as $stock) {
            $color = Color::find($stock->color_id);
            $jewelry = Jewelry::find($stock->jewelry_id);
            $vstock = Stock::where('color_jewelry_id', $stock->id)->first();

            // New Properties
            $stock->jewelryname = $jewelry->name;
            $stock->colorname = $color->color;
            $stock->stockquanity = $vstock->quantity;
        }

        $stocks = $stocks->map(function($stock) {
            return [
                'id' => $stock->id,
                'name' => $stock->jewelryname,
                'color' => $stock->colorname,
                'quantity' => $stock->stockquanity,
                'actions' => '<button class="btn btn-primary stock-edit" data-id="' . $stock->id . '">Details</button> ' .
                           '<button class="btn btn-secondary stock-delete" data-id="' . $stock->id . '">Delete</button> ' ,
                'full_data' => $stock
            ];
        });

        return response()->json($stocks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Storing Color_Jewelry Variant

        $validatedData = $request->validate([
            'jewelry' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
        ]);

        $jewelry = Jewelry::find($validatedData['jewelry']);
        $color = Color::find($validatedData['color']);
        
        if (!$jewelry || !$color) {
            return response()->json(['message' => 'Jewelry or Color not found'], 404);
        }

        $checkcolorjewel = ColorJewelry::where('jewelry_id', $jewelry->id)->where('color_id', $color->id)->first();
        if ($checkcolorjewel) {
            return response()->json(['message' => 'Jewelry Variant already exists'], 400);
        }

        $stock = new ColorJewelry();
        $stock->jewelry_id = $jewelry->id;
        $stock->color_id = $color->id;

        $imagePaths = [];
        
        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage'), $filename);
                $imagePaths[] = 'storage/' . $filename;
            }

            $stock->image_path = implode(',', $imagePaths);
        }

        $stock->save();

        $vstock = new Stock();
        $vstock->color_jewelry_id = $stock->id;
        $vstock->quantity = $validatedData['quantity'];
        $vstock->save();

        $response = [
            'id' => $stock->id,
            'name' => $jewelry->name,
            'color' => $color->color,
            'quantity' => $vstock->quantity,
            'actions' => '<button class="btn btn-primary stock-edit" data-id="' . $stock->id . '">Details</button> ' .
                        '<button class="btn btn-secondary stock-delete" data-id="' . $stock->id . '">Delete</button>',
        ];

        return response()->json($response, 201);
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stock = ColorJewelry::find($id);

        $color = Color::find($stock->color_id);
        $jewelry = Jewelry::find($stock->jewelry_id);
        $vstock = Stock::where('color_jewelry_id', $stock->id)->first();

        $stock = [
            'id' => $stock->id,
            'name' => $jewelry->name,
            'color' => $color->color,
            'quantity' => $vstock->quantity,
            'created_at' => $stock->created_at,
            'image_path' => $stock->image_path,
            'actions' => '<button class="btn btn-primary stock-edit" data-id="' . $stock->id . '">Details</button> ' .
                        '<button class="btn btn-secondary stock-delete" data-id="' . $stock->id . '">Delete</button>',
        ];

        return response()->json($stock);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stock = ColorJewelry::find($id);

        if (!$stock) {
            return response()->json(['message' => 'Jewelry Variant not found'], 404);
        }

        $validatedData = $request->validate([
            'stock' => 'required|numeric|min:0',
        ]);

        $vstock = Stock::where('color_jewelry_id', $stock->id)->first();
        if (!$vstock) {
            return response()->json(['message' => 'Stock not found'], 404);
        }
        $vstock->quantity = $validatedData['stock'];
        $vstock->save();

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage'), $filename); // Use public_path
                $imagePaths[] = 'storage/' . $filename;
            }

            $stock->image_path = implode(',', $imagePaths);
        }

        $stock->save();

        return response()->json($stock, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stock = ColorJewelry::find($id);

        if (!$stock) {
            return response()->json(['message' => 'Jewelry Variant not found'], 404);
        }

        $stock->delete();
        return response()->json(['message' => 'Jewelry Variant deleted successfully'], 200);
    }
}
