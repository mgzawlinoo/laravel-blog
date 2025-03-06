<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get post with pagination orderby desc update at desc
        $posts = Post::orderBy('updated_at', 'desc')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function search(Request $request) {
        $q = $request['q'];
        $data = Post::where('title', 'like', "%{$q}%")->orderBy('updated_at', 'desc')->paginate(5);
        return view('posts.index', ['posts' => $data, 'q' => $q]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        // get user (auth အတွက် မလုပ်ရသေးတဲ့ အတွက် လောလောဆယ် user ကို select ရွေးလို့ ရမယ်)
        $users = User::all();
        return view('posts.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        Post::create($request->all());
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        // get user (auth အတွက် မလုပ်ရသေးတဲ့ အတွက် လောလောဆယ် user ကို select ရွေးလို့ ရမယ်)
        $users = User::all();
        return view('posts.edit', compact('post', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
