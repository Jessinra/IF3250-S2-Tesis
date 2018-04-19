<?php
/**
 * Created by PhpStorm.
 * User: ROG
 * Date: 4/18/2018
 * Time: 9:13 PM
 */

namespace App\Http\Controllers;


use App\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class RekapDataController extends Controller
{
    public function showRekapMahasiswa(){
        $manajer = Auth::user()->isManajer();
        if($manajer){
            $mahasiswa = Mahasiswa::get();
            return view('manajer.rekap_data_mahasiswa',['mahasiswa' => $mahasiswa]);
        }else{
            return abort(303);
        }
    }
}