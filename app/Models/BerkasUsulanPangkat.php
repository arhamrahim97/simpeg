<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasUsulanPangkat extends Model
{
    use HasFactory;
    protected $table = 'berkas_usulan_pangkat';
    protected $guarded = ['id'];
}
