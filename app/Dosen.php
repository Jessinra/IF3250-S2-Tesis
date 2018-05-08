<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Dosen extends Model
{
    const STATUS_PENGUJI_2 = 1;
    const STATUS_PENGUJI_1 = 2;
    const STATUS_PEMBIMBING_2 = 3;
    const STATUS_PEMBIMBING_1 = 4;
    protected $fillable= ['id'];
    public static function getListDosenPembimbing1() {
        return Dosen::where('status','>=',Dosen::STATUS_PEMBIMBING_1)->get();
    }
    public static function getListDosenPembimbing2() {
        return Dosen::where('status','>=',Dosen::STATUS_PEMBIMBING_2)->get();
    }
    public function user() {
        return $this->belongsTo('\App\User','id','id');
    }

    public function user1() {
        return User::find($this->id);
    }
    
    public function getHasilBimbinganBelumDisetujui(){
        $hsl_bimbingan = HasilBimbingan::where('dosen_id',$this->id)->where('status',0)->get();
        return $hsl_bimbingan;
    }

    public function getHasilBimbingan(){
        //$hsl_bimbingan = HasilBimbingan::where('dosen_id',$this->id)->get();
        $hsl_bimbingan = HasilBimbingan::where('dosen_id',$this->id)->orderBy('status','asc')->orderBy('tanggal_waktu','desc')->get();
        return $hsl_bimbingan;
    }

    public static function getListDosenPenguji() {
        return Dosen::where('status', '>=',Dosen::STATUS_PENGUJI_2)->get();
    }

    public function upcomingSidangAsPenguji1() {
        return $this->hasMany('App\SidangTesis','dosen_penguji_1','id');
    }

    public function upcomingSidangAsPenguji2() {
        return $this->hasMany('App\SidangTesis','dosen_penguji_2','id');
    }

    public function sidangTesisNeedApproval() {
        return SidangTesis::where('ajuan_penguji1', $this->id)->orWhere('ajuan_penguji2',$this->id)->orWhere('ajuan_penguji3',$this->id)->get();
    }

    public function sidangTesisApproved() {
        return SidangTesis::where('dosen_penguji_1', $this->id)->orWhere('dosen_penguji_2',$this->id)->get();
    }
}
