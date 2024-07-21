<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

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
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:11',
            'address' => 'required|string|max:255',
            'birthdate' => 'nullable|date',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);

        // CREATE ROLE
        Role::create([
            'user_id' => $user->id,
            'title' => 'customer',
        ]);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     * Exclusive only for DataTable
     */
    public function show()
    {
        $users = User::all();
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

        // Handle password update
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

    // Activate Deactivated Account
    public function activate($id){
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
        } 

        return response()->json(['message' => 'User Activated Successfully'], 200);
    }

    public function deactivate(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user->delete();

            $token = $request->bearerToken();
            if ($token) {
                $sanctumToken = PersonalAccessToken::findToken($token);
                if ($sanctumToken) {
                    $sanctumToken->delete();
                }
            }

            $request->session()->invalidate();
            $request->session()->regenerateToken();
            // Auth::logout();

            return response()->json([
                'success' => true,
                'message' => 'Account successfully deleted.',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'User not found.',
        ], 404);
    }

    public function profile()
    {
        $userinfo = Auth::user();
        return view('customer.profile', compact('userinfo'));
    }

    public function getUserProfile()
    {
        $userinfo = Auth::user();
        return response()->json([
            'id' => $userinfo->id,
            'fname' => $userinfo->fname,
            'lname' => $userinfo->lname,
            'email' => $userinfo->email,
            'phone_number' => $userinfo->phone_number,
            'address' => $userinfo->address,
            'birthdate' => $userinfo->birthdate,
            'image_path' => $userinfo->image_path,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15', // Adjusted max length
            'address' => 'required|string|max:255',
            'new_password' => 'nullable|string|min:8', // Optional
        ]);

        $user->fname = $request->input('fname'); // Adjusted to match form field names
        $user->lname = $request->input('lname');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        $user->birthdate = $request->input('birthdate');

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->input('new_password'));
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image file if it exists
            if ($user->image_path && \File::exists(public_path($user->image_path))) {
                \File::delete(public_path($user->image_path));
            }

            // Store the new image file
            $image = $request->file('image');
            $filename = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage'), $filename);
            $user->image_path = 'storage/' . $filename;
        }

        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',
            'fname' => $user->fname,
            'lname' => $user->lname,
            'address' => $user->address,
            'phone_number' => $user->phone_number,
            'birthdate' => $user->birthdate,
            'image_path' => $user->image_path,
        ], 200);

    }

}
