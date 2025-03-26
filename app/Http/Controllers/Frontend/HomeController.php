<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tag;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Dislike;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'user', 'tags')->where('published', 1)->orderBy('updated_at', 'desc')->paginate(5);
        return view('frontend.index', compact('posts'));
    }

    public function post(Post $post)
    {
        if($post->published == 0) return redirect()->route('index');
        return view('frontend.post', compact('post'));
    }

    public function getPostsByCategory(Category $category)
    {
        // $posts = Post::where('category_id', $category->id)->get(); ဒါမျိုး မလိုအပ်တော့ပဲ model က eloquent ORM က
        // အောက်က အတိုင်း ယူသုံးလိုက်ရုံပဲ
        $posts = $category->posts()->with('category', 'user', 'tags')->where('published', 1)->orderBy('updated_at', 'desc')->paginate(5);
        $name = $category->name;
        return view('frontend.result', compact('posts', 'name'));
    }

    public function getPostsByUser(User $user)
    {

        // $posts = Post::where('user_id', $user->id)->get();
        // $posts = $user->posts()->get();
        // အထက်ပါ နည်းတွေ နဲ့လဲ ရတယ်

        $posts = $user->posts()->with('category', 'user', 'tags')->where('published', 1)->orderBy('updated_at', 'desc')->paginate(5);
        $name = $user->name;

        return view('frontend.result', compact('posts', 'name'));
    }

    public function getPostsByTag(Tag $tag)
    {
        $posts = $tag->posts()->with('category', 'user', 'tags')->where('published', 1)->orderBy('updated_at', 'desc')->paginate(5);
        $name = $tag->name;

        return view('frontend.result', compact('posts', 'name'));
    }

    public function like(Post $post)
    {
        // check already like
        $like = Like::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first();
        if(!$like) {

            // check dislike
            $dislike = Dislike::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first();
            if($dislike) {
                $dislike->delete();
            }
            Like::create([
                'post_id' => $post->id,
                'user_id' => Auth::user()->id,
            ]);

        } else {
            $like->delete();
        }

        return redirect()->back();
    }

    public function dislike(Post $post)
    {
        // check already dislike
        $dislike = Dislike::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first();
        if(!$dislike) {

            // check like
            $like = Like::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first();
            if($like) {
                $like->delete();
            }
            Dislike::create([
                'post_id' => $post->id,
                'user_id' => Auth::user()->id,
            ]);
        } else {
            $dislike->delete();
        }

        return redirect()->back();
    }


}
