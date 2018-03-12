<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    protected $fillable = [
        'mahasiswa_id','prioritas','judul','keilmuan','calon_pembimbing1','calon_pembimbing2'
    ];
}
