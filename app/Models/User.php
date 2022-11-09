<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $table = 'user';
    protected $primaryKey = 'UserID';
    protected $fillable = [
        'UserID',
        'UserAccount',
        'Password',
        'UserName',
        'Address',
        'Email',
        'PhoneNumber',
        'Image',
        'RoleID',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Password',
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
    public $timestamps = false;
    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function hasRole($roleID) {
        return null !== $this->table('user')->where('RoleID', $roleID)->first();
    }

}
