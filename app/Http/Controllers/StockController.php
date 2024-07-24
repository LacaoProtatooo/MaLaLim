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
        //
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
        // $stocks = ColorJewelry::with(['color', 'jewelry', 'stock'])->get();
        // Debugbar::info($stocks);

        // foreach($stocks as $stock) {
        //     $color = $stock->color;
        //     $jewelry = $stock->jewelry;
        //     $vstock = $stock->stock;

        //     // New Properties
        //     $stock->jewelryname = $jewelry->name;
        //     $stock->colorname = $color->color;
        //     $stock->stockquanity = $vstock->quantity;
        // }

        $stocks = ColorJewelry::all();
        Debugbar::info($stocks);

        foreach ($stocks as $stock) {
            $color = Color::find($stock->color_id);
            $jewelry = Jewelry::find($stock->jewelry_id);
            $vstock = Stock::where('color_jewelry_id', $stock->id)->first();

            // New Properties
            $stock->jewelryname = $jewelry ? $jewelry->name : 'N/A';
            $stock->colorname = $color ? $color->color : 'N/A';
            $stock->stockquanity = $vstock ? $vstock->quantity : 0;
        }

        $stocks = $stocks->map(function($stock) {
            return [
                'id' => $stock->id,
                'jewelryname' => $stock->jewelryname,
                'colorname' => $stock->colorname,
                'stockquanity' => $stock->stockquanity,
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
            // 'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048', // Validate each image file
        ]);

        $jewelry = Jewelry::where('name', $validatedData['jewelry'])->first();
        $color = Color::where('color', $validatedData['color'])->first();
        
        $stock = new ColorJewelry();
        $stock->jewelry_id = $jewelry;
        $stock->color_id = $color;

        $imagePaths = [];
        
        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage'), $filename); // Use public_path
                $imagePaths[] = 'storage/' . $filename;
            }

            $stock->image_path = implode(',', $imagePaths);
        }

        $stock->save();

        $vstock = new Stock();
        $vstock->color_jewelry_id = $stock->id;
        $vstock->quantity = $validatedData['quantity'];
        $vstock->save();

        return response()->json($stock, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stock = ColorJewelry::with(['color', 'jewelry', 'stock'])->find($id);
    
        if (!$stock) {
            return response()->json(['message' => 'Jewelry Variant not found'], 404);
        }

        $color = $stock->color;
        $jewelry = $stock->jewelry;
        $vstock = $stock->stock;
        
        $stock->jewelryname = $jewelry->name;
        $stock->colorname = $color->color;
        $stock->quantity = $vstock->quantity;

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
            'quantity' => 'required|numeric|min:0',
        ]);

        $vstock = Stock::where('color_jewelry_id', $stock->id)->first();
        if (!$vstock) {
            return response()->json(['message' => 'Stock not found'], 404);
        }
        $vstock->quantity = $validatedData['quantity'];
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
