<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileGuruPegawai extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'profile_guru_pegawai';
    protected $guarded = ['id'];

    public function berkasDasar()
    {
        return $this->hasMany(BerkasDasar::class, 'id_user', 'id_user');
    }
  
    public function unitKerja()
    {
        return $this->hasOne(UnitKerja::class, 'id', 'unit_kerja');
    }

    public function jabatanStruktural()
    {
        return $this->hasOne(jabatanStruktural::class, 'id', 'jabatan_pangkat_golongan');
    }

    public function jabatanFungsional()
    {
        return $this->hasOne(jabatanFungsional::class, 'id', 'jabatan_pangkat_golongan');
    }
}
