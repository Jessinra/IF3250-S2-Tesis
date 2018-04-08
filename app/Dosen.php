<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        $hsl_bimbingan = HasilBimbingan::where('dosen_id',$this->id)->get();
        return $hsl_bimbingan;
    }
}
