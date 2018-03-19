<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Mahasiswa extends Model
{
    const STATUS_MENUNGGU_TOPIK = 0;
    const STATUS_TOPIK_TELAH_DIAJUKAN = 1;
//    const STATUS_SIAP_SEMINAR_TOPIK = 1;
//    const STATUS_MENUNGGU_PROPOSAL = 2;
//    const STATUS_SIAP_SEMINAR_PROPOSAL = 3;
//    const STATUS_MASA_BIMBINGAN = 4;
//    const STATUS_SIAP_SEMINAR_TESIS = 5;
//    const STATUS_SIAP_SIDANG_TESIS = 6;
//    const STATUS_LULUS = 7;
    const STATUS_STRINGS = [
        "Menunggu Topik","Siap Seminar Topik", "Menunggu Proposal", "Siap Seminar Proposal", "Masa Bimbingan",
        "Siap Seminar Tesis", "Siap Sidang Tesis", "Lulus"
    ];
    protected $fillable= ['id'];
    public function getStatus($status) {
        return Mahasiswa::STATUS_STRINGS[$status];
    }

    public function getTopiks() {
        $topics =  Topik::where('mahasiswa_id',Auth::user()->id)->get();
        return $topics;
    }

    public function user() {
        return User::find($this->id);
    }
    //

}
