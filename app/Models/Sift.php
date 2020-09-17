<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sift extends Model
{
    public function karyawans()
    {
        return $this->belongsToMany(Karyawan::class, 'karyawan_sift');
    }
}
