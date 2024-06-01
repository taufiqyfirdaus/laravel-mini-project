<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookmarkedPosts = $user->bookmarks()->with('user')->orderBy('pivot_created_at', 'desc')->get();

        return view('pages.bookmark', compact('bookmarkedPosts'));
    }
    public function addBookmark(Post $post)
    {
        $user = Auth::user();

        if ($user->bookmarks()->where('post_id', $post->id)->exists()) {
            $user->bookmarks()->detach($post->id);
        } else {
            $user->bookmarks()->attach($post->id);
        }

        return response()->json(['status' => 'success']);
    }

}