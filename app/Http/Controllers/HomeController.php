<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // get categories
        $categories = Category::all();

        // get users
        $users = User::all();

        $posts = Post::with('category', 'user')->orderBy('published', 'desc')->orderBy('updated_at', 'desc')->paginate(5);
        return view('frontend.index', compact('posts', 'categories', 'users'));
    }

    public function post(Post $post)
    {
        return view('frontend.post', compact('post'));
    }

    public function getPostsByCategory(Category $category)
    {
        // get categories
        $categories = Category::all();

        // get users
        $users = User::all();

        // $posts = Post::where('category_id', $category->id)->get(); ဒါမျိုး မလိုအပ်တော့ပဲ model က eloquent ORM က
        // အောက်က အတိုင်း ယူသုံးလိုက်ရုံပဲ
        $posts = $category->posts()->with('category', 'user')->get();
        return view('frontend.index', compact('posts', 'categories', 'users'));
    }

    public function getPostsByUser(User $user)
    {
        // get categories
        $categories = Category::all();

        // get users
        $users = User::all();

        // $posts = Post::where('user_id', $user->id)->get();
        // $posts = $user->posts()->get();
        // အထက်ပါ နည်းတွေ နဲ့လဲ ရတယ်

        $posts = $user->posts()->with('category', 'user')->get();

        return view('frontend.index', compact('posts', 'categories', 'users'));
    }

}
