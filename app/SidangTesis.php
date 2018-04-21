<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidangTesis extends Model
{
    protected $table = 'sidang_tesis';
    protected $fillable =
        ['thesis_id','id','nilai_dosen_penguji_1_utama'.'nilai_dosen_penguji_2_utama','nilai_dosen_pembimbing_utama','nilai_dosen_penguji_1_penting'.'nilai_dosen_penguji_2_penting','nilai_dosen_pembimbing_penting','nilai_dosen_penguji_1_pendukung'.'nilai_dosen_penguji_2_pendukung','nilai_dosen_pembimbing_pendukung','nilai_dosen_kelas_penting','nilai_dosen_kelas_utama'];

    public function tesis() {
        return $this->belongsTo('App\Thesis', 'thesis_id','id');
    }


    public function dosen_penguji_1() {
        return $this->belongsTo('App\User','dosen_penguji_1','id');
    }

    public function dosen_penguji_2() {
        return $this->belongsTo('App\User','dosen_penguji_2','id');
    }
}
