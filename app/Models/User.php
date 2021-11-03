<?php

namespace App\Models;

use App\Models\BerkasDasar;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ProfileGuruPegawai;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
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


    // protected $hidden = [
    //     'password',
    // ];

    public function profile()
    {
        return $this->hasOne(ProfileGuruPegawai::class, 'id_user', 'id');
    }

    public function profilePejabat()
    {
        return $this->hasOne(ProfilePejabat::class, 'id_user', 'id');
    }

    // public function berkasDasar()
    // {
    //     return $this->hasOne(BerkasDasar::class, 'id_user', 'id');
    // }

    public function berkasDasar()
    {
        return $this->hasMany(BerkasDasar::class, 'id_user', 'id');
    }
}
