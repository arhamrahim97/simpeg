<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskripsiPersyaratan extends Model
{
    use HasFactory;
    protected $table = 'deskripsi_persyaratan';
    protected $guarded = ['id'];
}
