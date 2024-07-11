<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Divisi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'divisi';
    protected $quarted = [];
    // public function divisi()
    //     {
    //         return $this->belongsTo(Divisi::class, 'id_divisi');
    //     }

}
