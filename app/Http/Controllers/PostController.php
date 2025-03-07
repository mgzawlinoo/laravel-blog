<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
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
        if(strlen($q) > 2) {
            $data = Post::where('title', 'like', "%{$q}%")->orderBy('updated_at', 'desc')->paginate(5);
            return view('posts.index', ['posts' => $data, 'q' => $q]);
        }
        return redirect()->route('posts.index')->with('search', 'Search must be at least 3 characters long');
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
        if($request->hasFile('photo')) $path = $request->file('photo')->store('photos', 'public');
        else  $path = null;

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'photo' => $path,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id
        ]);
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
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
        // update လုပ်တဲ့ အထဲ ပုံ အသစ် မပါရင် နဂို db ထဲက path ကိုပဲ update ထည့်မယ်
        // တကယ်လို့ ပါနေရင် db က path ထဲက ပုံကို ဖျက်ပြီး အခု ပုံကို upload တင်မယ်, path အသစ်ကို update ထည့်မယ်
        $path = $post->photo;
        if($request->hasFile('photo')) {
            if(!empty($path)) { Storage::disk('public')->delete($path); }
            $path = $request->file('photo')->store('photos', 'public');
        }

        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'photo' => $path,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id
        ]);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $result = $post->delete();
        if($result) {
            if(!empty($post->photo)) { Storage::disk('public')->delete($post->photo); }
        }
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
