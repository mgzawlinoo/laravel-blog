<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Like;
use App\Models\Post;
use App\Models\Dislike;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeDislikeController extends Controller
{

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
