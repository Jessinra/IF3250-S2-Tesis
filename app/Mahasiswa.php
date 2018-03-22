<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Mahasiswa extends Model
{
    const STATUS_MENUNGGU_TOPIK = 0;
    const STATUS_TOPIK_TELAH_DIAJUKAN = 1;
    const STATUS_NOT_ACTIVE = -999;
//    const STATUS_SIAP_SEMINAR_TOPIK = 1;
//    const STATUS_MENUNGGU_PROPOSAL = 2;
//    const STATUS_SIAP_SEMINAR_PROPOSAL = 3;
//    const STATUS_MASA_BIMBINGAN = 4;
//    const STATUS_SIAP_SEMINAR_TESIS = 5;
//    const STATUS_SIAP_SIDANG_TESIS = 6;
//    const STATUS_LULUS = 7;
    protected $statusString = [
        "0" => "Menunggu topik",
        "1" => "Topik telah diajukan",
        "2" => "Topik telah disetujui",
        "3" => "Siap seminar topik",
        "4" => "Lulus seminar topik",
        "5" => "Menunggu proposal",
        "6" => "Proposal telah diajukan",
        "7" => "Proposal telah disetujui",
        "8" => "Siap seminar proposal",
        "9" => "Lulus seminar proposal",
        "10" => "Dosen pembimbing telah ditetapkan",
        "11" => "Masa bimbingan",
        "12" => "Siap Seminar Tesis",
        "13" => "Lulus Seminar Tesis",
        "14" => "Siap Sidang Tesis",
        "15" => "Lulus",
        "-999" => "Akun tidak aktif",
        "-1" => "Semua Topik ditolak",
    ];
    protected $fillable= ['id'];
    public function getStatus($status) {
        return Mahasiswa::STATUS_STRINGS[$status];
    }

    public function getTopiks() {
        $topics =  Topik::where('mahasiswa_id',$this->id)->orderBy('prioritas','asc')->get();
        return $topics;
    }

    public function user() {
        return User::find($this->id);
    }
    //
    public function getStatusString() {
        return $this->statusString[$this->status];
    }
}
