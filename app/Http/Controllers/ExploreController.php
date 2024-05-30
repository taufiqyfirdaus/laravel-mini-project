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
        return view('pages.explore', compact('randomUsers'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $results = [];

        if ($searchTerm) {
            $results = User::where('username', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('name', 'LIKE', "%{$searchTerm}%")
                            ->get();
        }

        return view('pages.explore', [
            'results' => $results,
            'searchTerm' => $searchTerm
        ]);
    }
    public function userRecommendation($loggedInUserId)
    {
        return User::where('id', '!=', $loggedInUserId)
                   ->inRandomOrder()
                   ->limit(3)
                   ->get();
    }
}