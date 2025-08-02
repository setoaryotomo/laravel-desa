<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    protected $table = 'rumah';

    protected $guarded = [];

    public function penghunis()
    {
        return $this->hasMany(Penghuni::class, 'rumah_id');
    }

    
}
