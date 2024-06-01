<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    protected $fillable = [
        'follower_id',
        'following_id',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function followingUser()
    {
        return $this->belongsTo(User::class, 'following_id');
    }

    public function followerUser()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
}