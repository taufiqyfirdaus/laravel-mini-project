<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function showFormAdd(){
        $user_id = Auth::user()->id;
        return view('pages.formPost', compact('user_id'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'post_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('show-form-add-post')
                ->withErrors($validator)
                ->withInput();
        }
        
        $file = $request->file('post_pic');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move('storage/post', $fileName);

        Post::create([
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'post_pic' => '/storage/post/' . $fileName,
        ]);

        return redirect()->route('home')->with('success', 'Postingan Berhasil dibuat.');
    }
    
    public function showPost(Request $request){
        $loggedInUserId = Auth::id();
        $randomUsers = $this->userRecommendation($loggedInUserId);
        
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('pages.home', compact('posts', 'randomUsers'));
    }

    public function userRecommendation($loggedInUserId)
    {
        return User::where('id', '!=', $loggedInUserId)
                   ->inRandomOrder()
                   ->limit(3)
                   ->get();
    }

    // public function showDetailPost($postSlug){
    //     $post = Post::where('slug', $postSlug)->firstOrFail();
    //     return view('pages.seePost', compact('post'));
    // }

    public function showDetailPost(Post $post){
        return view('pages.seePost', compact('post'));
    }
}