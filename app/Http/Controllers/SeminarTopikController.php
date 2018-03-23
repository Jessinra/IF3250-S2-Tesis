<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\SeminarTopik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SeminarTopikController extends Controller
{
   public function penetapanJadwal(Request $request) {
       $manajer= Auth::user()->isManajer();
       $mhs_id = $request->get('mahasiswa');
       $mahasiswa = Mahasiswa::find($mhs_id);
       if($manajer) {
            if($mahasiswa) {
                SeminarTopik::create(
                    [
                        "mahasiswa_id" => $mhs_id,
                        "schedule" => $request->get("date")
                    ]
                )
                $mahasiswa->status = Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK;
                $mahasiswa->save();

            } else {
                return abort(400);
            }

       } else {
           return abort(403);
       }
   }
}
