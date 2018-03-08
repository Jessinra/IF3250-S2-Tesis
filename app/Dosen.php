<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    const STATUS_PENGUJI_2 = 1;
    const STATUS_PENGUJI_1 = 2;
    const STATUS_PEMBIMBING = 3;
    protected $fillable= ['id'];

}
