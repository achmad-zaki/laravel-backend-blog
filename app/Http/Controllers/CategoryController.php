<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
        ]);

        $slug = Str::slug($validated['name']);

        $post = Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
        ]);

        return ApiResponse::success(data: $post, status: 201);
    }
}
