<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    public $status = [
        "0" => "Diajukan",
        "1" => "<font color=green>Diterima</font>",
        "2" => "<font color=red>Ditolak</font>"
    ];
    protected $fillable = [
        'mahasiswa_id','prioritas','judul','keilmuan','calon_pembimbing1','calon_pembimbing2'
    ];

    public function dosen_pembimbing1() {
        return $this->belongsTo('App\Dosen', 'calon_pembimbing1', 'id');
    }

    public function dosen_pembimbing2() {
            return $this->belongsTo('App\Dosen', 'calon_pembimbing2', 'id');
    }
    public function getStatusString() {
        return $this->status[$this->status_id];
    }
}
