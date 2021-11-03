<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilePejabat extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'profile_pejabat';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function jabatanStruktural()
    {
        return $this->hasOne(jabatanStruktural::class, 'id', 'jabatan_pangkat_golongan');
    }
}
