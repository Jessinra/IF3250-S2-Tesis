<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    const STATUS_MENUNGGU_TOPIK = 0;
    const STATUS_SIAP_SEMINAR_TOPIK = 1;
    const STATUS_MENUNGGU_PROPOSAL = 2;
    const STATUS_SIAP_SEMINAR_PROPOSAL = 3;
    const STATUS_MASA_BIMBINGAN = 4;
    const STATUS_SIAP_SEMINAR_TESIS = 5;
    const STATUS_SIAP_SIDANG_TESIS = 6;
    const STATUS_LULUS = 7;
    const STATUS_STRINGS = [
        "Menunggu Topik","Siap Seminar Topik", "Menunggu Proposal", "Siap Seminar Proposal", "Masa Bimbingan",
        "Siap Seminar Tesis", "Siap Sidang Tesis", "Lulus"
    ];
    public function getStatus($status) {
        return Mahasiswa::STATUS_STRINGS[$status];
    }

    //
}
