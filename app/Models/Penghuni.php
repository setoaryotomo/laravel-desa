<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $table = 'penghuni';

    protected $guarded = [];

    public function rumahs()
    {
        return $this->hasOne(Rumah::class, "id","rumah_id");
    }

    public function rumah()
    {
        return $this->belongsTo(Rumah::class, 'rumah_id');
    }

    public function anggotakeluargas()
    {
        return $this->hasMany(Anggotakeluarga::class, 'penghuni_id');
    }
}
