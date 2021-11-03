<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulanPangkat extends Model
{
    use HasFactory;
    protected $table = 'usulan_pangkat';

    public function berkasUsulanPangkat()
    {
        return $this->hasMany(BerkasUsulanPangkat::class, 'id_usulan_pangkat', 'id');
    }

    public function pangkatFungsionalSebelumnya()
    {
        return $this->hasOne(JabatanFungsional::class, 'id', 'pangkat_sebelumnya');
    }

    public function pangkatFungsionalSelanjutnya()
    {
        return $this->hasOne(JabatanFungsional::class, 'id', 'pangkat_selanjutnya');
    }

    public function pangkatStrukturalSebelumnya()
    {
        return $this->hasOne(JabatanStruktural::class, 'id', 'pangkat_sebelumnya');
    }

    public function pangkatStrukturalSelanjutnya()
    {
        return $this->hasOne(JabatanStruktural::class, 'id', 'pangkat_selanjutnya');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function profileGuruPegawai()
    {
        return $this->hasOne(ProfileGuruPegawai::class, 'id_user', 'id_user');
    }
}
