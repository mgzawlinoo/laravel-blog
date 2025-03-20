<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        $posts = Auth::user()->posts()->withTrashed()
        ->orderBy('updated_at', 'desc')->paginate(5);

        return view('backend.posts.index', compact('posts'));
    }

    // public function search(Request $request) {
    //     $q = $request['q'];
    //     if(strlen($q) > 2) {
    //         $data = Post::where('title', 'like', "%{$q}%")->orderBy('updated_at', 'desc')->paginate(5);
    //         return view('backend.posts.index', ['posts' => $data, 'q' => $q]);
    //     }
    //     return redirect()->route('backend.posts.index')->with('search', 'Search must be at least 3 characters long');
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get()->pluck('name', 'id');
        $tags = Tag::get()->pluck('name', 'id');
        return view('backend.posts.create', compact('categories', 'tags'));
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
            'user_id' => Auth::user()->id,
            'published' => $request->published ? 1 : 0,
            'description' => $request->description,
        ]);

        return redirect()->route('backend.posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (! Gate::allows('crud-post', $post)) {
            abort(403);
        }
        return view('backend.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (! Gate::allows('crud-post', $post)) {
            abort(403);
        }
        $categories = Category::all();
        // get user (auth အတွက် မလုပ်ရသေးတဲ့ အတွက် လောလောဆယ် user ကို select ရွေးလို့ ရမယ်)
        // $users = User::all();
        return view('backend.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if (! Gate::allows('crud-post', $post)) {
            abort(403);
        }
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
            'user_id' => Auth::user()->id,
            'published' => $request->published ? 1 : 0,
            'description' => $request->description,
        ]);
        return redirect()->route('backend.posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (! Gate::allows('crud-post', $post)) {
            abort(403);
        }
        $post->timestamps = false;
        $post->delete();
        return redirect()->route('backend.posts.index')->with('danger', 'Post deleted.');
    }

    public function permanentDelete(Post $post)
    {
        if (! Gate::allows('crud-post', $post)) {
            abort(403);
        }
        $post->forceDelete();
        if(!empty($post->photo)) { Storage::disk('public')->delete($post->photo); }
        return redirect()->route('backend.posts.index')->with('danger', 'Post deleted permanently.');
    }

    public function restore(Post $post)
    {
        if (! Gate::allows('crud-post', $post)) {
            abort(403);
        }
        $post->timestamps = false;
        $post->restore();
        return redirect()->route('backend.posts.index')->with('success', 'Post restored.');
    }
}
