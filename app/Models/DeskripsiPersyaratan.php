<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DeskripsiPersyaratan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'deskripsi_persyaratan';
    protected $guarded = ['id'];
}
