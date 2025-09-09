<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'username',
        'email',
        'password',
    ];

    //Accessor it's a way to filter a value of a coulmn coming from the DB
    protected function avatar(): Attribute
    {
        return Attribute::make(get: function($value){
            return $value? '/storage/avatars/' . $value : '/fallback-avatar.png';
        });
    }

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
    public function postsThroughFollow()
    {
        return $this->hasManyThrough(
            Post::class,
            Follow::class,
            'user_id',        // Foreign key on Follow table...
            'user_id',        // Foreign key on Post table...
            'id',             // Local key on User table...
            'followeduser'    // Local key on Follow table...
        );
    }

    //Post relationship
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

  public function followers()
  {
    return $this->hasMany(Follow::class, 'followeduser');
  }

    public function following()
    {
        return $this->hasMany(Follow::class, 'user_id');
    }

}
