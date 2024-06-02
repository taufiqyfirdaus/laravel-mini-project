<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function addFollow(Request $request, $id)
    {
        $userToFollow = User::findOrFail($id);
        $loggedInUser = Auth::user();

        $existingFollow = Follower::where('follower_id', $loggedInUser->id)
            ->where('following_id', $userToFollow->id)
            ->first();

        if ($existingFollow) {
            // Unfollow
            $existingFollow->delete();
            return response()->json([
                'status' => 'unfollowed',
                'followers_count' => $userToFollow->followers()->count(),
            ]);
        } else {
            // Follow
            Follower::create([
                'follower_id' => $loggedInUser->id,
                'following_id' => $userToFollow->id,
            ]);
            return response()->json([
                'status' => 'followed',
                'followers_count' => $userToFollow->followers()->count(),
            ]);
        }
    }

    public function showFollowers($userId)
    {
        $user = User::findOrFail($userId);
        $followers = $user->followers()->get();

        return view('profiles.followers', compact('user', 'followers'));
    }

    public function searchFollowers(Request $request)
    {
        $searchTerm = $request->input('search', '');
        $results = [];
        $followers = [];

        if ($searchTerm) {
            $loggedInUserId = Auth::id();
            $followersIds = Follower::where('following_id', $loggedInUserId)->pluck('follower_id');
            $results = User::whereIn('id', $followersIds)
                ->where(function($query) use ($searchTerm) {
                    $query->where('username', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('name', 'LIKE', "%{$searchTerm}%");
                })
                ->get();
        }
        
        $user = Auth::user();
        $followers = $user->followers()->get();

        return view('profiles.followers', [
            'results' => $results,
            'searchTerm' => $searchTerm,
            'followers' => $followers,
        ]);
    }

    public function showFollowings($userId)
    {
        $user = User::findOrFail($userId);
        $followings = $user->followings()->get();

        return view('profiles.followings', compact('user', 'followings'));
    }

    public function searchFollowings(Request $request)
    {
        $searchTerm = $request->input('search', '');
        $results = [];
        $followings = [];

        if ($searchTerm) {
            $loggedInUserId = Auth::id();
            $followingsIds = Follower::where('follower_id', $loggedInUserId)->pluck('following_id');
            $results = User::whereIn('id', $followingsIds)
                ->where(function($query) use ($searchTerm) {
                    $query->where('username', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('name', 'LIKE', "%{$searchTerm}%");
                })
                ->get();
        }
        
        $user = Auth::user();
        $followings = $user->followings()->get();

        return view('profiles.followings', [
            'results' => $results,
            'searchTerm' => $searchTerm,
            'followings' => $followings,
        ]);
    }
    
}