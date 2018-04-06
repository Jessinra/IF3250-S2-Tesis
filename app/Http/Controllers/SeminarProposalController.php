<?php

namespace App\Http\Controllers;

use App\SeminarProposal;
use App\SeminarTopik;
use Illuminate\Http\Request;

class SeminarProposalController extends Controller
{
    public function scheduleEstablishment(Request $request) {
        $manajer= Auth::user()->isManajer();
        $mhs_id = $request->get('mahasiswa');
        $mahasiswa = Mahasiswa::find($mhs_id);
        if($manajer) {
            if($mahasiswa) {
                SeminarTopik::create(
                    [
                        "mahasiswa_id" => $mhs_id,
                        "schedule" => $request->get("date"),
                        "creator_id" => $manajer->id
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
}
