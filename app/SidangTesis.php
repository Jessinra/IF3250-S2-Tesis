<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidangTesis extends Model
{
    protected $table = 'sidang_tesis';
    public function tesis() {
        return $this->belongsTo('App\Thesis', 'thesis_id','id');
    }
}
