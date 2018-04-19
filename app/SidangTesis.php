<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidangTesis extends Model
{
    protected $table = 'sidang_tesis';
    protected $fillable =
        ['thesis_id'];

    public function tesis() {
        return $this->belongsTo('App\Thesis', 'thesis_id','id');
    }


    public function dosen_penguji() {
        return $this->belongsTo('App\User','dosen_penguji','id');
    }
}
