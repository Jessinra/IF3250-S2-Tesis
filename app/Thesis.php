<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    public $table = "thesis";
    protected $fillable= ['id','dosen_pembimbing1','dosen_pembimbing2','mahasiswa_id','topic','keilmuan','creator','opsi'];

    public function dosen_pembimbing_1() {
        return $this->belongsTo('App\Dosen', 'dosen_pembimbing1', 'id');
    }

    public function dosen_pembimbing_2() {
        return $this->belongsTo('App\Dosen', 'dosen_pembimbing2', 'id');
    }

    public function mahasiswa(){
        return $this->belongsTo('App\Mahasiswa', 'mahasiswa_id', 'id');
    }

    public function creator_admin() {
        return $this->belongsTo('App\User','creator','id');
    }
}
