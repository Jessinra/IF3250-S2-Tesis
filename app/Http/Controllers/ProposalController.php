<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Proposal;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProposalController extends Controller
{
    public function showUploadForm() {
        return view('mahasiswa.proposal.upload');
    }
    public function upload(Request $request)
    {
        $user = Auth::user();
        $mhs = $user->isMahasiswa();

        if ($mhs) {
            $proposal = $request->file('proposal');
            if ($proposal) {
                $path = $proposal->storeAs($user->username, $proposal->getClientOriginalName());
                Proposal::create([
                    "mahasiswa_id" => $mhs->id,
                    "filesize" => $proposal->getSize(),
                    "filename" => $proposal->getClientOriginalName(),
                    "path" => $path
                ]);
                $mhs->status = Mahasiswa::STATUS_PROPOSAL_TELAH_DIAJUKAN;
                $mhs->t_proposal1 = date("Y-m-d H:i:s");
                $mhs->save();
                return redirect("/");
            } else {
                return abort(400);
            }
        } else {
            return abort(403);
        }
    }

    public function download($id, $filename) {
        $usr = Auth::user();
        $mhs_id = $id;
        $mhs_usr  = User::where('username',$mhs_id)->first();
        $mhs_mhs = $mhs_usr->isMahasiswa();
        if($usr->isManajer() || $usr->username == $mhs_id) {
            return Storage::download($id.'/'.$filename, "", [""]);
        } else {
            return abort(403);
        }
    }

    public function approval(Request $request) {
        echo json_encode($request->all());
        $usr = Auth::user();
        $mhs_id = $request->get('mahasiswa');
        $prop_id = $request->get('proposal');
        $prop_obj = Proposal::find($prop_id);
        $mhs_obj = Mahasiswa::find($mhs_id);
        $mnj_action = $request->get('action');
        if($usr->isManajer() && $prop_obj->mahasiswa_id == $mhs_id) {
            if($mnj_action == Proposal::ACTION_PROPOSAL_DITERIMA) {
                $prop_obj->status = Proposal::STATUS_PROPOSAL_DITERIMA;
                $mhs_obj->status = Mahasiswa::STATUS_PROPOSAL_DITERIMA;
                $mhs_obj->t_proposal2 = date("Y-m-d H:i:s");
            }
            else if ($mnj_action == Proposal::ACTION_PROPOSAL_DITOLAK) {
                $prop_obj->status = Proposal::STATUS_PROPOSAL_DITOLAK;
                $mhs_obj->status = Mahasiswa::STATUS_PROPOSAL_DITOLAK;
            }
            else
                return abort(400);
            $prop_obj->evaluator_id = $usr->id;
            $prop_obj->save();
            $mhs_obj->save();
            return redirect('/mahasiswa/control/'.$mhs_obj->user()->username);
        } else {
            return abort(403);
        }
    }


}
