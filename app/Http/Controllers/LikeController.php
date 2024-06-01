<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function addLike(Post $post)
    {
        $user = Auth::user();

        if ($user->likes()->where('post_id', $post->id)->exists()) {
            $user->likes()->detach($post->id);
            return response()->json(['status' => 'unliked']);
        } else {
            $user->likes()->attach($post->id);
            return response()->json(['status' => 'liked']);
        }
    }
}