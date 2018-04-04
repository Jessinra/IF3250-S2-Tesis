<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Mahasiswa extends Model
{
    const STATUS_MENUNGGU_TOPIK = 0;
    const STATUS_TOPIK_TELAH_DIAJUKAN = 1;
    const STATUS_NOT_ACTIVE = -999;
    const STATUS_TOPIK_DITERIMA = 2;
    const STATUS_TOPIK_DITOLAK = -1;
    const STATUS_SIAP_SEMINAR_TOPIK = 3;
    const STATUS_LULUS_SEMINAR_TOPIK = 4;
    const STATUS_GAGAL_SEMINAR_TOPIK = -4;

    const STATUS_MENUNGGU_PROPOSAL = 5;
    const STATUS_PROPOSAL_TELAH_DIAJUKAN = 6;
    const STATUS_PROPOSAL_DITERIMA = 7;
    const STATUS_PROPOSAL_DITOLAK = -7;
    const STATUS_SIAP_SEMINAR_PROPOSAL = 8;
    const STATUS_LULUS_SEMINAR_PROPOSAL = 9;
    const STATUS_GAGAL_SEMINAR_PROPOSAL = -9;

    const STATUS_MASA_BIMBINGAN = 10;
    const STATUS_SIAP_SEMINAR_TESIS = 11;
    const STATUS_LULUS_SEMINAR_TESIS = 12;
    const STATUS_GAGAL_SEMINAR_TESIS = -12;

    const STATUS_SIAP_SIDANG_TESIS = 13;
    const STATUS_LULUS = 14;

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
        "-4" => "Gagal Seminar Topik",
        "-7" => "Proposal Ditolak"
    ];
    protected $fillable= ['id'];
    public function getStatus($status) {
        return Mahasiswa::STATUS_STRINGS[$status];
    }

    public function getTopics() {
        $topics =  Topic::where('mahasiswa_id',$this->id)->orderBy('prioritas','asc')->get();
        return $topics;
    }
    public function getTopicApproval() {
        return $this->hasMany('App\TopicApproval','mahasiswa_id','id')->orderBy('created_at','DESC')->first();
    }
    public function user() {
        return User::find($this->id);
    }

    public function seminarTopik() {
        return $this->hasMany('App\SeminarTopik')->orderBy('created_at',"DESC")->first();
    }
    //
    public function getStatusString() {
        return $this->statusString[$this->status];
    }

    public function proposal() {
        return $this->hasOne('App\Proposal')->orderBy('created_at',"DESC")->first();
    }
}
