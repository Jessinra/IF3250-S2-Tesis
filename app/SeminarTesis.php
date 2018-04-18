<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeminarTesis extends Model
{
    //
    protected $fillable =[
        'tesis_id','tempat','hari','tanggal','approval_pembimbing1','approval_pembimbing2','issuer_id','evaluator_id','verdict', 'waktu'
    ];

    public function getApprovalStringPembimbing1() {
        if($this->approval_pembimbing1) {
            return "<font color='green'>Sudah Menyetujui </font>";
        } else {
            return "<font color='red'>Belum Menyetujui </font>";
        }
    }

    public function getApprovalStringPembimbing2() {
        if($this->approval_pembimbing2) {
            return "<font color='green'>Sudah Menyetujui </font>";
        } else {
            return "<font color='red'>Belum Menyetujui </font>";
        }
    }

    public function tesis() {
        return $this->belongsTo('App\Thesis', 'tesis_id','id');
    }
    public function evaluator() {
        return $this->belongsTo('App\User','evaluator_id','id');
    }
}
