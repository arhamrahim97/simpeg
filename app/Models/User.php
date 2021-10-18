<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;
    use SoftDeletes;
    protected $table = 'user';
    protected $guarded = ['id'];


    protected $hidden = [
        'password',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'id_user', 'id');
    }
}
