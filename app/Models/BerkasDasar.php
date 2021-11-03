<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasDasar extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'berkas_dasar';
    protected $guarded = [];

    // public function getRouteKeyName()
    // {
    //     return 'id_user';
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
