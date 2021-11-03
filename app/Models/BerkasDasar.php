<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasDasar extends Model
{
    use HasFactory;
    protected $table = 'berkas_dasar';
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'id_user';
    }
}
