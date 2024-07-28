<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

use App\Models\Jewelry;
use App\Models\Price;
use App\Models\Classification;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class JewelryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    public function dtpopulate(){
        $jewelries = Jewelry::all();
        $jewelries = $jewelries->map(function($jewelry) {
            return [
                'id' => $jewelry->id,
                'name' => $jewelry->name,
                'actions' => '<button class="btn btn-primary jewelry-edit" data-id="' . $jewelry->id . '">Details</button> ' .
                             '<button class="btn btn-secondary jewelry-delete" data-id="' . $jewelry->id . '">Delete</button> ' .
                             '<button class="btn btn-success jewelry-material" data-id="' . $jewelry->id . '">Assign Materials</button>',
                'full_data' => $jewelry
            ];

        });
        return response()->json($jewelries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'classification' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            // 'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $jewelry = new Jewelry();
        $imagePaths = [];

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage'), $filename); // Use public_path
                $imagePaths[] = 'storage/' . $filename;
            }

            $validatedData['image_path'] = implode(',', $imagePaths);
            $jewelry->image_path = $validatedData['image_path'];
        }

        $jewelry->name = $validatedData['name'];
        $jewelry->description = $validatedData['description'];
        $jewelry->classification_id = $validatedData['classification'];
        $jewelry->save();

        $price = new Price();
        $price->jewelry_id = $jewelry->id;
        $price->price = $validatedData['price'];
        $price->save();

        return response()->json($jewelry, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jewelry = Jewelry::find($id);
        if (!$jewelry) {
            return response()->json(['message' => 'Jewelry not found'], 404);
        }

        $price = Price::where('jewelry_id', $jewelry->id)->first();
        $jewelry->price = $price ? $price->price : null;

        return response()->json($jewelry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jewelry = Jewelry::find($id);
        if (!$jewelry) {
            return response()->json(['message' => 'Jewelry not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'classification' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            // 'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $imagePaths = [];

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage'), $filename);
                $imagePaths[] = 'storage/' . $filename;
            }

            $validatedData['image_path'] = implode(',', $imagePaths);
            $jewelry->image_path = $validatedData['image_path'];
        }

        $jewelry->name = $validatedData['name'];
        $jewelry->description = $validatedData['description'];
        $jewelry->classification_id = $validatedData['classification'];
        $jewelry->save();

        if ($request->has('price')) {
            $price = Price::where('jewelry_id', $jewelry->id)->first();
            $price->price = $validatedData['price'];
            $price->save();
        }

        return response()->json($jewelry, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jewelry = Jewelry::find($id);

        if (!$jewelry) {
            return response()->json(['message' => 'Jewelry not found'], 404);
        }

        $jewelry->delete();
        return response()->json(['message' => 'Jewelry deleted successfully'], 200);
    }

    public function modpop($id)
    {
        // Find the jewelry by ID
        $jewelry = Jewelry::find($id);

        if (!$jewelry) {
            return response()->json(['error' => 'Jewelry not found'], 404);
        }

        // Get all materials
        $allMaterials = Material::all();

        // Get the IDs of materials associated with the specific jewelry
        $associatedMaterialIds = $jewelry->materials->pluck('id')->toArray();

        // Add 'hasJewelry' attribute to each material
        $allMaterials->each(function ($material) use ($associatedMaterialIds) {
            $material->hasJewelry = in_array($material->id, $associatedMaterialIds);
        });

        return response()->json($allMaterials, 200);
    }

    public function save(Request $request, string $id)
    {
        $checkedMaterialIds  = $request->checkedJewelryIds;
        $uncheckedMaterialIds = $request->uncheckedJewelryIds;
        $jewel = Jewelry::find($id);
        if (!$jewel) {
            return response()->json(['error' => 'jewel not found'], 404);
        }

        if (!empty($checkedMaterialIds)) {
            $jewel->materials()->syncWithoutDetaching($checkedMaterialIds);
        }

        if (!empty($uncheckedMaterialIds)) {
            $jewel->materials()->detach($uncheckedMaterialIds);
        }

        return response()->json($request, 200);

    }

}
