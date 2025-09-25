<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable = [
        'caption',
        'slug',
        'user_id',
    ];

    public function imagepost()
    {
        return $this->hasMany(imagepost::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes(){
        $this->belongsToMany(Post::class,'likes');
    }
    
}
