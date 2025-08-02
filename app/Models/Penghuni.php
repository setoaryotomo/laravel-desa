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
}
