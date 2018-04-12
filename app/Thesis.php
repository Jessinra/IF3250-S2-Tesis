<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    public $table = "thesis";
    protected $fillable= ['id'];

    public function dosen_pembimbing1() {
        return $this->belongsTo('App\Dosen', 'dosen_pembimbing1', 'id');
    }

    public function dosen_pembimbing2() {
        return $this->belongsTo('App\Dosen', 'dosen_pembimbing2', 'id');
    }

    public function mahasiswa(){
        return $this->belongsTo('App\Mahasiswa', 'mahasiswa_id', 'id');
    }

    public function creator() {
        return $this->belongsTo('App\User','creator','id');
    }
}
