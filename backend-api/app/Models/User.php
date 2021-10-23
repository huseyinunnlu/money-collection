<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['fullName'],
                'onUpdate' => true,
            ],
        ];
    }

    protected $fillable = [
        'fullName',
        'email',
        'password',
        'profilePhoto'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function authUserToken()
    {
        return $this->hasMany('App\Models\OAuthAccessToken');
    }
}
