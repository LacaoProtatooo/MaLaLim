<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Display users
    public function create()
    {
        $users = User::all();
        return view('admin.adminusers', compact('users'));
    }

    // Store a new user
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user);
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        return response()->json($user);
    }

    // Update the specified user in storage
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user);
    }

    // Remove the specified user from storage
    public function delete(User $user)
    {
        $user->delete();
        return response()->json(['success' => true]);
    }
}
