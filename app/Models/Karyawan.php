<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    public function sifts()
    {
        return $this->belongsToMany(Sift::class, 'karyawan_sift');
    }
}
