<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Luilliarcec\LaravelUsernameGenerator\Facades\Username;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'is_admin',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'id_user');
    }
    public function data_ports()
    {
        return $this->hasMany(DataPorts::class, 'id_user');
    }

    // public function olt_ports()
    // {
    //     return $this->belongsToMany(oltPort::class, 'pengajuans', 'id_user', 'id_port')
    //         ->withPivot('izin')
    //         ->withTimestamps();
    //     // return $this->belongsToMany(Category::class, 'categorys_users', 'category_id', 'user_id');
    // }

    public function sluggable(): array
    {
        return [
            'username' => [
                'source' => 'name'
            ]
        ];
    }
}
