<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeminarTopik extends Model
{
    //
    const ACTION_LULUS = 1;
    const ACTION_GAGAL = 0;
    protected $fillable = [
        "mahasiswa_id","schedule","creator_id","passed","evaluator_id"
    ];

    public function creator() {
        return $this->belongsTo('App\User','creator_id','id');
    }

    public function evaluator() {
        return $this->belongsTo('App\User','evaluator_id','id');
    }
}
