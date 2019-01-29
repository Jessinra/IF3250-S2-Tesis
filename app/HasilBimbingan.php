<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilBimbingan extends Model
{
    const STATUS_DIAJUKAN = 0;
    const STATUS_DITERIMA = 1;
    const STATUS_NON_AKTIF = -1;

    public $statusString = [
        "0" => "Diajukan",
        "1" => "Diterima",
        "-1" => "Non-Aktif"
    ];

    protected $fillable = [
        'id','dosen_id','status','tanggal_waktu','topik','hasil_dan_diskusi','rencana_tindak_lanjut', 'dosen_id2', 'waktu_bimbingan_selanjutnya', 'thesis_id'];

    public function dosen_pembimbing() {
        return $this->belongsTo('App\Dosen', 'dosen_id', 'id');
    }

    public function dosen_pembimbing2() {
        return $this->belongsTo('App\Dosen', 'dosen_id2', 'id');
    }

    public function thesis() {
        return $this->belongsTo('App\Thesis', 'thesis_id', 'id');
    }

    public function getStatusString() {
        return $this->statusString[$this->status];
    }
}
