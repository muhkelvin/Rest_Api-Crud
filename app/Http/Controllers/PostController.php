<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostSingleResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{

    public function index()
    {
         return PostResource::collection(Post::paginate(10));
    }


    public function store(Request $request)
    {
        try {
            $post = Post::create([
                'title' => $request->title,
                'slug' => strtolower(Str::slug($request->title . '-'. Str::random(5))),
                'body' => $request->body,
            ]);

            return response()->json([
                'message' => 'Post created successfully',
                'post' => new PostSingleResource($post),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create post',
                'error' => $e->getMessage(),
            ], 400);
        }
    }



    public function show(Post $post)
    {
        return new PostSingleResource($post);
    }


    public function update(Request $request, Post $post)
    {
        try {
            $post->update([
                'title' => $request->title,
                'slug' => strtolower(Str::slug($request->title . '-' . Str::random(5))),
                'body' => $request->body,
            ]);

            return response()->json([
                'message' => 'Post updated successfully',
                'post' => new PostSingleResource($post),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update post',
                'error' => $e->getMessage(),
            ], 400);
        }
    }



    public function destroy(Post $post)
    {
        try {
            $post->delete();

            return response()->json([
                'message' => 'Post deleted successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete post',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

}
