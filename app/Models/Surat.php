<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    const STATUS_DIPROSES = 1;
    const STATUS_DISETUJUI = 2;
    const STATUS_TERKIRIM = 3;
    const STATUS_DITOLAK = 4;
    
    protected $table = 'surat';

    protected $guarded = [];
}
