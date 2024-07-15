<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * WEB.PHP
     */
    public function index()
    {
        return view('admin.adminusers');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:11',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     * Exclusive only for DataTable
     */
    public function show()
    {
        $users = User::all();
        // Transform users data to include only necessary fields for DataTables
        $users = $users->map(function($user) {
            return [
                'id' => $user->id,
                'lname' => $user->lname,
                'fname' => $user->fname,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'actions' => '<button class="btn btn-primary editUser" data-id="' . $user->id . '">Edit</button> 
                              <button class="btn btn-danger deleteUser" data-id="' . $user->id . '">Delete</button>
                              <button class="btn btn-info detailsUser" data-id="' . $user->id . '">Details</button>',
                'full_data' => $user // Keep full data for modal
            ];
        });
        return response()->json($users);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $user->update($validatedData);
        return response()->json($user, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
