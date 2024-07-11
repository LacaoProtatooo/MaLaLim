<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Display users
    public function usercreate()
    {
        $users = User::all();
        return view('admin.adminusers', compact('users'));
    }

    // Store a new user
    public function userstore(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user);
    }

    public function useredit($id)
    {
        return response()->json($id);
    }

    public function userupdate(Request $request, $id)
    {
        $id->update($request->all());
        return response()->json($id);
    }

    public function userdelete($id)
    {
        User::destroy($id->id);
        return response()->json(['success' => true]);
    }
}
