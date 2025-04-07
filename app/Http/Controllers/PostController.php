<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $limit = $request->get('limit', 5);
        $posts = Post::with('user', 'comments.user')->when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%")
                ->orWhere('published_at', 'like', "%{$search}%");
        })->paginate($limit);

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => PostResource::collection($posts->items()),
            'pagination' => [
                'current_page' => $posts->currentPage(),
                // 'next_page_url' => $posts->nextPageUrl(),
                'has_more_pages' => $posts->hasMorePages(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ]
        ]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['user', 'comments.user'])->first();

        if (!$post) {
            return ApiResponse::error(message: 'Postingan tidak ditemukan', status: 404);
        }

        return ApiResponse::success(data: new PostResource($post));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:posts,title',
            'content' => 'required',
            'thumbnail' => 'nullable',
        ], [
            'title.unique' => 'Judul sudah dibuat.',
            'title.required' => 'Title tidak boleh kosong.',
            'title.max' => 'Title maximal 200 karakter.',
            'content.required' => 'Content tidak boleh kosong.',
        ]);

        $slug = Str::slug($validated['title']);

        $post = Post::create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'thumbnail' => $validated['thumbnail'] ?? null,
            'published_at' => $validated['published_at'] ?? Carbon::now(),
        ]);

        return ApiResponse::success(data: $post, status: 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return ApiResponse::error(message: 'Post tidak ditemukan.', status: 404);
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable',
        ], [
            'title.required' => 'Title tidak boleh kosong.',
            'title.max' => 'Title maximal 200 karakter.',
            'content.required' => 'Content tidak boleh kosong.',
        ]);

        if ($request->has('title')) {
            $post->slug = Str::slug($validated['title']);
        }

        $post->update($validated);

        return ApiResponse::success(message: 'Post berhasil diubah.', data: new PostResource($post));
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return ApiResponse::error(message: 'Post tidak ditemukan.', status: 404);
        }

        if ($post->user_id !== $request->user()->id) {
            return ApiResponse::error(message: 'Kamu tidak memiliki izin untuk menghapus post ini.', status: 403);
        }

        $post->delete();

        return ApiResponse::success(message: 'Post berhasil dihapus.');
    }
}
