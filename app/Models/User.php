<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'image',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }          
    public function likes(){
        $this->belongsToMany(Post::class,'likes');
    }          
    public function following(){
        return $this->belongsToMany(User::class,'follows', relatedPivotKey:'user_id',foreignPivotKey: 'following_user_id')->withPivot('is_accepted')->withTimestamps();
    }
    public function follower(){
        return $this->belongsToMany(User::class,'follows',relatedPivotKey: 'following_user_id',foreignPivotKey:'user_id')->withPivot('is_accepted')->withTimestamps();
    }                   
}
