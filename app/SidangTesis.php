<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidangTesis extends Model
{
    protected $table = 'sidang_tesis';
    protected $fillable =
        ['thesis_id','id','nilai', 'tanggal', 'jam','dosen_penguji_1','dosen_penguji_2','nilai_dosen_penguji_1_utama'.'nilai_dosen_penguji_2_utama','nilai_dosen_pembimbing_utama','nilai_dosen_penguji_1_penting'.'nilai_dosen_penguji_2_penting','nilai_dosen_pembimbing_penting','nilai_dosen_penguji_1_pendukung'.'nilai_dosen_penguji_2_pendukung','nilai_dosen_pembimbing_pendukung','nilai_dosen_kelas_penting','nilai_dosen_kelas_utama'];

    public function tesis() {
        return $this->belongsTo('App\Thesis', 'thesis_id','id');
    }


    public function dosen_penguji1() {
        return $this->belongsTo('App\User','dosen_penguji_1','id');
    }

    public function dosen_penguji2() {
        return $this->belongsTo('App\User','dosen_penguji_2','id');
    }

    public function ajuan_penguji_1() {
        return $this->belongsTo('App\User','ajuan_penguji1','id');
    }
    public function ajuan_penguji_2() {
        return $this->belongsTo('App\User','ajuan_penguji2','id');
    }
    public function ajuan_penguji_3() {
        return $this->belongsTo('App\User','ajuan_penguji3','id');
    }

    public function approval_status_string($status) {
        if($status) {
            return "<span class='text-color-green'>Telah Setuju</span>";
        } else {
            return "<span class='text-color-red'>Belum Setuju</span>";
        }
    }
    
}
