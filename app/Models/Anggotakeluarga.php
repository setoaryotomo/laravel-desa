<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggotakeluarga extends Model
{
    protected $table = 'anggotakeluarga';

    protected $guarded = [];

    public function penghunis()
    {
        return $this->hasOne(Penghuni::class, "id","penghuni_id");
    }

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class, 'penghuni_id');
    }
}
