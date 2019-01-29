<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    public $table = "thesis";
    protected $fillable= ['id','dosen_pembimbing1','dosen_pembimbing2','mahasiswa_id','topic','keilmuan','creator','opsi','judul_thesis'];

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
    public function seminarTesis() {
        return $this->hasMany('App\SeminarTesis','tesis_id','id')->orderBy('created_at','DESC')->first();
    }

    public function getHasilBimbinganAktif() {
        return $this->hasMany('App\HasilBimbingan')->where('status','!=',-1)->get();
    }

    public function sidangTesis() {
        return $this->hasMany('App\SidangTesis','thesis_id','id')->orderBy('created_at','DESC')->first();
    }

    

}
