<?php

namespace App\Http\Controllers;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function dtpopulate(Request $request)
    {
        if($request->input('matid'))
        {
            $materials= Material::find($request->input('matid'));

            return response()->json($materials);
        }
        $materials = Material::all();
        $materials = $materials->map(function($material) {
            return [
            'material' => $material->material,
            'description' => $material->description,
            'actions' => '<button class="btn btn-primary material-edit" data-id="' . $material->id . '">Details</button> ' .
                           '<button class="btn btn-secondary material-delete" data-id="' . $material->id . '">Delete</button>',
            'full_data' => $material
            ];
        });
        return response()->json($materials);
    }

    public function store(Request $request)
    {

        if($request->matid)
        {
            $material = Material::find($request->matid);
            $material->material = $request->material;
            $material->description = $request->description;
            $material->save();

            return response()->json($material, 201);
        }
        $validatedData = $request->validate([
            'material' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // return response()->json(['success' => true,'form'=> $validatedData
    //  ]);
        $material = new Material();

        $material->material = $validatedData['material'];
        $material->description = $validatedData['description'];
        $material->save();

        return response()->json($material, 201);

    }

   public function delete(string $id)
   {
        $material = Material::find($id);

        if (!$material) {
            return response()->json(['message' => 'material not found'], 404);
        }

        $material->delete();
        return response()->json(['message' => 'material deleted successfully'], 200);
   }


}
