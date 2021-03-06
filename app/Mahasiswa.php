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

    const STATUS_DOSEN_PEMBIMBING_TELAH_DIPILIH = 10;
    const STATUS_MASA_BIMBINGAN = 11;
    const STATUS_SIAP_SEMINAR_TESIS = 12;
    const STATUS_LULUS_SEMINAR_TESIS = 13;
    const STATUS_GAGAL_SEMINAR_TESIS = -13;

    const STATUS_SIAP_SIDANG_TESIS = 14;
    const STATUS_LULUS = 15;

    public $statusString = [
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
        "-7" => "Proposal Ditolak",
        "-9" => "Gagal Seminar Proposal",
        "-13" => "Gagal Seminar Tesis"
    ];
    protected $fillable= ['id','id_kelas_tesis'];
    public function getStatus($status) {
        return Mahasiswa::STATUS_STRINGS[$status];
    }

    public function getTopics() {
        $topics =  Topic::where('mahasiswa_id',$this->id)->orderBy('prioritas','asc')->get();
        return $topics;
    }

    public function getApprovedTopic() {
        return Topic::where('mahasiswa_id',$this->id)->where('status','1')->first();
    }
    public function getTopicApproval() {
        return $this->hasMany('App\TopicApproval','mahasiswa_id','id')->orderBy('created_at','DESC')->first();
    }

    public function getHasilBimbingan(){
        $hsl_bimbingan = HasilBimbingan::where('thesis_id',$this->tesis()->id)->orderBy('status','asc')->orderBy('tanggal_waktu','desc')->get();
        //$hsl_bimbingan = HasilBimbingan::where('mahasiswa_id',$this->id)->get();
        return $hsl_bimbingan;
    }

    public function getHasilBimbinganBelumDisetujui(){
        $hsl_bimbingan = HasilBimbingan::where('thesis_id',$this->tesis()->id)->where('status',0)->orWhere('status',-1)->get();
        return $hsl_bimbingan;
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
    public function tesis() {
        return $this->hasOne('App\Thesis','mahasiswa_id','id')->orderBy('created_at',"DESC")->first();
    }

    public function seminarProposal() {
        return $this->hasMany('App\SeminarProposal')->orderBy('created_at',"DESC")->first();
    }

    public function kelasTesis() {
        return $this->belongsTo('App\KelasTesis','id_kelas_tesis','id');
    }
}
