<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // get post with pagination orderby desc update at desc
        $posts = Post::orderBy('published', 'desc')->orderBy('updated_at', 'desc')->paginate(5);
        return view('frontend.index', compact('posts'));
    }
}
