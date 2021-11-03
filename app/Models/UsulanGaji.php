<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulanGaji extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'usulan_gaji';

    public function berkasUsulanGaji()
    {
        return $this->hasMany(BerkasUsulanGaji::class, 'id_usulan_gaji', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','id_user');
    }

    public function profileGuruPegawai()
    {
        return $this->hasOne(ProfileGuruPegawai::class, 'id_user', 'id_user');
    }
}
