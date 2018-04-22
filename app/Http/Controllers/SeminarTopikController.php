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
                        "schedule" => $request->get("date"),
                        "creator_id" => $manajer->id,
                        "topik_id" => $mahasiswa->getApprovedTopic()->id
                    ]
                );
                $mahasiswa->status = Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK;
                $mahasiswa->save();
                return redirect('/mahasiswa/control/'.$mahasiswa->user()->username);
            } else {
                return abort(400);
            }

       } else {
           return abort(403);
       }
   }

   public function penilaian(Request $request) {
       $manajer= Auth::user()->isManajer();
        if($manajer) {
            echo json_encode($request->all());
            $mahasiswa_id = $request->get('mahasiswa');
            $mhs = Mahasiswa::find($mahasiswa_id);

            $action = $request->get('action');
            $st = $mhs->seminarTopik();
            $st->passed = $action;
            $st->evaluator_id = $manajer->id;
            if($action) {
                $mhs->status = Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK;
            } else {
                $mhs->status = Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK;

            }

            $mhs->save();
            $st->save();
            return redirect('/mahasiswa/control/'.$mhs->user()->username);

        } else {
            return abort(403);
        }

   }
}
