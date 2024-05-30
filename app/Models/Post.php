<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_pic',
        'description',
        'user_id'
    ];
    
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function userLikes()
    {
        return $this->hasMany(Like::class)->where('user_id', auth()->id());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}