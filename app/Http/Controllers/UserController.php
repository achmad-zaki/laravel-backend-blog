<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $validated['name'];

        $user->save();

        return ApiResponse::success(
            message: 'Profil berhasil diperbarui.',
            data: new UserResource($user)
        );
    }

    public function show(Request $request)
    {
        $user = $request->user();
        return ApiResponse::success(data: $user->only(['id', 'name', 'avatar', 'email', 'created_at']));
    }
}
