<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidangTesis extends Model
{
    public function tesis() {
        return $this->belongsTo('App\Thesis', 'tesis_id','id');
    }
}
