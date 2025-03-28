<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        // check own follow
        if(Auth::user()->id != $user->id) {
            // check already follow
            $follow = Follower::where('user_id', Auth::user()->id)->where('following_id', $user->id)->first();
            if(!$follow) {
                Follower::create([
                    'user_id' => Auth::user()->id,
                    'following_id' => $user->id
                ]);
            }
        }
        return redirect()->back();
    }

    public function unfollow(User $user)
    {
        $follow = Follower::where('user_id', Auth::user()->id)->where('following_id', $user->id)->first();
        if($follow) {
            $follow->delete();
        }
        return redirect()->back();
    }
}
