<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilBimbingan extends Model
{
    protected $fillable = [
        'id','mahasiswa_id','dosen_id','status','tanggal_waktu','topik','hasil_dan_diskusi','rencana_tindak_lanjut'];

    public function dosen_pembimbing() {
        return $this->belongsTo('App\Dosen', 'dosen_id', 'id');
    }

    public function mahasiswa() {
        return $this->belongsTo('App\Mahasiswa', 'mahasiswa_id', 'id');
    }

    public function getStatusString() {
        return $this->statusString[$this->status];
    }
}
