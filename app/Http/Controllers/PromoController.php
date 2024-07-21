<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Promo;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    // CUSTOM
    public function dtpopulate(){
        $promos = Promo::all();
        $promos = $promos->map(function($promo) {
            return [
                'id' => $promo->id,
                'name' => $promo->name,
                'description' => $promo->description,
                'discountRate' => $promo->discountRate,
                'actions' => '<button class="btn btn-primary editPromo" data-id="' . $promo->id . '">Edit</button> 
                              <button class="btn btn-danger deletePromo" data-id="' . $promo->id . '">Delete</button>
                              <button class="btn btn-info detailsPromo" data-id="' . $promo->id . '">Details</button>',
                'full_data' => $promo
            ];
        });
        return response()->json($promos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'discountRate' => 'required|numeric|min:0',
            // 'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048', // Validate each image file
        ]);

        $imagePaths = [];
        
        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage'), $filename); // Use public_path
                $imagePaths[] = 'storage/' . $filename;
            }

            $validatedData['image_path'] = implode(',', $imagePaths);
        }
        
        $promo = Promo::create($validatedData);

        return response()->json($promo, 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $promo = Promo::find($id);
        if (!$promo) {
            return response()->json(['message' => 'Promo not found'], 404);
        }
        
        return response()->json($promo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $promo = Promo::find($id);
        if (!$promo) {
            return response()->json(['message' => 'Promo not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'discountRate' => 'required|numeric|min:0',
            // 'image_path' => 'sometimes|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $imagePaths = [];
        
        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage'), $filename); // Store images in a 'promos' directory
                $imagePaths[] = 'storage/' . $filename;
            }
        }
        
        $validatedData['image_path'] = implode(',', $imagePaths); // Store paths as a comma-separated string

        $promo->update($validatedData);

        return response()->json($promo, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $promo = Promo::find($id);

        if (!$promo) {
            return response()->json(['message' => 'Promo not found'], 404);
        }

        $promo->delete();
        return response()->json(['message' => 'Promo deleted successfully'], 200);
    }
}
