<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dosen extends Model
{
    const STATUS_PENGUJI_2 = 1;
    const STATUS_PENGUJI_1 = 2;
    const STATUS_PEMBIMBING = 3;
    protected $fillable= ['id'];
    public function user() {
        return User::find($this->id);
    }

    public function getHasilBimbinganBelumDisetujui(){
        $hsl_bimbingan = HasilBimbingan::where('dosen_id',$this->id)->where('status',0)->get();
        return $hsl_bimbingan;
    }

    public function getHasilBimbingan(){
        //$hsl_bimbingan = HasilBimbingan::where('dosen_id',$this->id)->get();
        $hsl_bimbingan = HasilBimbingan::join('users', 'mahasiswa_id', '=', 'users.id')
                            ->where('dosen_id',$this->id)
                            ->orderBy('tanggal_waktu','desc')->orderBy('status','asc')
                            ->select('hasil_bimbingans.id', 'mahasiswa_id', 'dosen_id', 'status', 'tanggal_waktu', 'topik', 'hasil_dan_diskusi', 'rencana_tindak_lanjut', 'users.name', 'users.username')
                            ->get();
        return $hsl_bimbingan;
    }
}
