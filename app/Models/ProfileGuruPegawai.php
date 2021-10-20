<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileGuruPegawai extends Model
{
    use HasFactory;
    protected $table = 'profile_guru_pegawai';
    protected $guarded = ['id'];
}
