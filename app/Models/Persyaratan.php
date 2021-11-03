<?php

namespace App\Models;

use App\Models\JabatanFungsional;
use App\Models\DeskripsiPersyaratan;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persyaratan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'persyaratan';
    protected $guarded = ['id'];



    public function deskripsiPersyaratan()
    {
        return $this->hasMany(DeskripsiPersyaratan::class, 'id_persyaratan', 'id');
    }

    public function jabatanFungsional()
    {
        return $this->hasOne(JabatanFungsional::class, 'id', 'ke_golongan');
    }

    public function jabatanStruktural()
    {
        return $this->hasOne(JabatanStruktural::class, 'id', 'ke_golongan');
    }
}
