<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Atribut dari Laratrust.
     *
     * @var array
     */
    public static function boot()
    {
        parent::boot();

        static::roleAttached(function ($user, $role, $team) {
        });
        static::roleSynced(function ($user, $changes, $team) {
        });
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function wishlists()
    {
        return $this->morphMany(Wishlist::class, 'wishlistable');
    }
}
