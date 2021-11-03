<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileGuruPegawai extends Model
{
    use HasFactory;
    protected $table = 'profile_guru_pegawai';
    protected $guarded = ['id'];

    public function unitKerja()
    {
        return $this->hasOne(UnitKerja::class, 'id', 'unit_kerja');
    }

    public function jabatanStruktural()
    {
        return $this->hasOne(JabatanStruktural::class, 'id', 'jabatan_pangkat_golongan');
    }

    public function jabatanFungsional()
    {
        return $this->hasOne(JabatanFungsional::class, 'id', 'jabatan_pangkat_golongan');
    }
}
