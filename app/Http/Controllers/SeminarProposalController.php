<?php

namespace App\Http\Controllers;

use App\SeminarProposal;
use App\SeminarTopik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mahasiswa;

class SeminarProposalController extends Controller
{
    public function scheduleEstablishment(Request $request) {
        $manajer= Auth::user()->isManajer();
        $mhs_id = $request->get('mahasiswa');
        $mahasiswa = Mahasiswa::find($mhs_id);
        if($manajer) {
            if($mahasiswa) {
                SeminarProposal::create(
                    [
                        "mahasiswa_id" => $mhs_id,
                        "schedule" => $request->get("date"),
                        "creator_id" => $manajer->id,
                        "proposal_id" => $mahasiswa->proposal()->id,
                        "id_dosen_pembimbing_1" => $request->get('dosen_pembimbing_1'),
                        "id_dosen_pembimbing_2" => $request->get('dosen_pembimbing_2'),
                        "id_dosen_penguji" => $request->get('dosen_penguji')

                    ]
                );
                $mahasiswa->status = Mahasiswa::STATUS_SIAP_SEMINAR_PROPOSAL;
                $mahasiswa->t_proposal3 = date("Y-m-d H:i:s");
                $mahasiswa->save();
                return redirect('/mahasiswa/control/'.$mahasiswa->user()->username);
            } else {
                return abort(400);
            }

        } else {
            return abort(403);
        }
    }

    public function score(Request $request) {
        $manajer= Auth::user()->isManajer();
        if($manajer) {
            $mahasiswa_id = $request->get('mahasiswa');
            $mhs = Mahasiswa::find($mahasiswa_id);
            $score = $request->get('score');
            $sp = $mhs->seminarProposal();
            $sp->mark_dosen_pembimbing = $request->get('mark_dosen_pembimbing');
            $sp->mark_dosen_penguji = $request->get('mark_dosen_penguji');
            $sp->passed = $score!='D' && $score != 'E';
            $sp->evaluator_id = $manajer->id;
            $sp->score = $score;
            if($sp->passed) {
                $mhs->status = Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL;
                $mhs->t_proposal4 = date("Y-m-d H:i:s");
            } else {
                $mhs->status = Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL;
            }
            $mhs->save();
            $sp->save();
            return redirect('/mahasiswa/control/'.$mhs->user()->username);

        } else {
            return abort(403);
        }
    }
}
