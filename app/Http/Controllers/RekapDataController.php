<?php
/**
 * Created by PhpStorm.
 * User: ROG
 * Date: 4/18/2018
 * Time: 9:13 PM
 */

namespace App\Http\Controllers;


use App\Mahasiswa;
use App\SidangTesis;
use Illuminate\Support\Facades\Auth;

class RekapDataController extends Controller
{
    public function showRekapMahasiswa(){
        $manajer = Auth::user()->isManajer();
        if($manajer){
            $mahasiswa = Mahasiswa::join('users','users.id','=','mahasiswas.id')
                                    ->select('users.username','mahasiswas.*')
                                    ->where('mahasiswas.status', '!=', Mahasiswa::STATUS_NOT_ACTIVE)
                                    ->where('mahasiswas.status', '!=', Mahasiswa::STATUS_LULUS)
                                    ->orderBy('users.username','asc')
                                    ->get();
            return view('manajer.rekap_data_mahasiswa',['mahasiswa' => $mahasiswa]);
        }else{
            return abort(303);
        }
    }

    public function showRekapNilaiAkhir(){
        $manajer = Auth::user()->isManajer();
        if($manajer){
            $sidang_tesis = SidangTesis::get();
            $mahasiswa = Mahasiswa::get();
            return view('manajer.nilai_akhir_mahasiswa',['sidang_tesis' => $sidang_tesis]);
        }else{
            return abort(303);
        }
    }

    public function showHistoryMahasiswa(){
        $manajer = Auth::user()->isManajer();
        if($manajer) {
            $mahasiswa = Mahasiswa::join('users','users.id','=','mahasiswas.id')
                                    ->select('users.username','mahasiswas.*')
                                    ->where('mahasiswas.status', '=', Mahasiswa::STATUS_NOT_ACTIVE)
                                    ->orWhere('mahasiswas.status', '=', Mahasiswa::STATUS_LULUS)
                                    ->orderBy('mahasiswas.status','desc')
                                    ->orderBy('users.username','asc')
                                    ->get();
            return view('manajer.mahasiswa_history_control', ['mahasiswa' => $mahasiswa]);
        } else {
            abort(403);
        }
    }
}