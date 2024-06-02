<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{
    public function index()
    {
        $loggedInUserId = Auth::id();
        $randomUsers = $this->userRecommendation($loggedInUserId);
        
        return view('pages.explore', [
            'randomUsers' => $randomUsers
        ]);
    }


    public function search(Request $request)
    {
        $loggedInUserId = Auth::id();
        
        $searchTerm = $request->input('search');
        $results = [];

        if ($searchTerm) {
            $results = User::where('username', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('name', 'LIKE', "%{$searchTerm}%")
                            ->get();
        }

        $randomUsers = $this->userRecommendation($loggedInUserId);

        return view('pages.explore', [
            'results' => $results,
            'searchTerm' => $searchTerm,
            'randomUsers' => $randomUsers
        ]);
    }
    public function userRecommendation($loggedInUserId)
    {
        return User::where('id', '!=', $loggedInUserId)
               ->whereDoesntHave('followers', function($query) use ($loggedInUserId) {
                   $query->where('follower_id', $loggedInUserId);
               })
               ->inRandomOrder()
               ->limit(3)
               ->get();
    }
}