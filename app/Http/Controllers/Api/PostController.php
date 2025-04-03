<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return response()->json([
            'posts' => $posts,
            'message' => 'Success'
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return response()->json([
            'post' => $post,
            'message' => 'Success'
        ]);
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->title)
        ]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|min:4',
            'slug' => 'string|unique:posts,slug',
            'description' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'published' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        if($request->hasFile('photo')) $path = $request->file('photo')->store('photos', 'public');
        else  $path = null;

        $post = Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'photo' => $path,
            'published' => $request->published
        ]);

        if (!$post) {
            return response()->json([
                'error' => 'Post could not be created'
            ], 422);
        }

        return response()->json([
            'post' => $post,
            'message' => 'Post created successfully',
        ], 201);
    }

    public function update(Request $request)
    {
        $post = Post::find($request->id);
        if (!$post) {
            return response()->json([
                'error' => 'Post not found'
            ], 422);
        }

        $request->merge([
            'slug' => Str::slug($request->title)
        ]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|min:4',
            'slug' => 'string|unique:posts,slug,' . $post->id,
            'description' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'published' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        $path = $post->photo;
        if($request->hasFile('photo')) {
            if(!empty($path)) { Storage::disk('public')->delete($path); }
            $path = $request->file('photo')->store('photos', 'public');
        }

        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'photo' => $path,
            'published' => $request->published
        ]);

        return response()->json([
            'post' => $post,
            'message' => 'Post updated successfully',
        ], 200);
    }
}
