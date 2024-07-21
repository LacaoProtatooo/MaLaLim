<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Courier;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
    }

    public function dtpopulate(){
        $couriers = Courier::all();
        $couriers = $couriers->map(function($courier) {
            return [
            'id' => $courier->id,
            'name' => $courier->name,
            'rate' => $courier->rate,
            'actions' => '<button class="btn btn-primary courier-edit" data-id="' . $courier->id . '">Details</button> ' .
                           '<button class="btn btn-secondary courier-delete" data-id="' . $courier->id . '">Delete</button>',
            'full_data' => $courier
            ];
        });
        return response()->json($couriers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0',
        ]);

        $courier = Courier::create($validatedData);

        return response()->json($courier, 201);
    }

    /**
     * Display the specified resource. DETAILS
     */
    public function show(string $id)
    {
        $courier = Courier::find($id);
        if (!$courier) {
            return response()->json(['message' => 'Courier not found'], 404);
        }
        
        return response()->json($courier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $courier = Courier::find($id);
        if (!$courier) {
            return response()->json(['message' => 'Courier not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0',
        ]);

        $courier->update($validatedData);
        return response()->json($courier, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $courier = Courier::find($id);

        if (!$courier) {
            return response()->json(['message' => 'Courier not found'], 404);
        }

        $courier->delete();
        return response()->json(['message' => 'Courier deleted successfully'], 200);
    }
}
