<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasUsulanGaji extends Model
{
    use HasFactory;
    protected $table = 'berkas_usulan_gaji';
    protected $guarded = ['id'];
}
