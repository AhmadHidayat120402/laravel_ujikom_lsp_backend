<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function show(Request $request)
    {

        return response()->json($request->user());
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input jika diperlukan
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'unique:users,email,',
            'username' => 'string|max:255',
            'phone' => 'string|max:255',
        ]);

        $user->update($validatedData);

        return response()->json(['message' => 'Profile updated successfully', 'data' => $user], 200);
    }
}
