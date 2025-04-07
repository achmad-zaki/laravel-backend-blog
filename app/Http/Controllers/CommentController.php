<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $comments = Comment::all();

        // return ApiResponse::success(data: CommentResource::collection($comments));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $slug)
    {
        $validated = $request->validate([
            'content' => 'required|max:100',
        ], [
            'content.required' => 'Komentar tidak boleh kosong.',
            'content.max' => 'Komentar terlalu panjang.'
        ]);

        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return ApiResponse::error(message: 'Post tidak ditemukan.', status: 404);
        }


        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
            'content' => $validated['content']
        ]);

        return ApiResponse::success(message: 'Komentar berhasil di kirim.', data: new CommentResource($comment));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return ApiResponse::error(message: 'Komentar tidak ditemukan.', status: 404);
        }

        if ($comment->user_id !== $request->user()->id) {
            return ApiResponse::error(message: 'Anda tidak memiliki izin untuk menghapus komentar ini.', status: 403);
        }

        $comment->delete();

        return ApiResponse::success(message: 'Komentar berhasil dihapus.');
    }
}
