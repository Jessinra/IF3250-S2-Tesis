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
    public function showUploadForm()
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);

        return view('mahasiswa.proposal.upload');
    }

    public function upload(Request $request)
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);

        $mhs = $auth->isMahasiswa();
        if (!$mhs) {
            return abort(403);
        }

        $proposal = $request->file('proposal');
        if (!$proposal) {
            return abort(400);
        }

        $path = $proposal->storeAs($user->username, $proposal->getClientOriginalName());

        Proposal::create([
            "mahasiswa_id" => $mhs->id,
            "filesize" => $proposal->getSize(),
            "filename" => $proposal->getClientOriginalName(),
            "path" => $path,
        ]);

        $mhs->status = Mahasiswa::STATUS_PROPOSAL_TELAH_DIAJUKAN;
        $mhs->t_proposal1 = date("Y-m-d H:i:s");
        $mhs->save();

        return redirect("/");
    }

    public function download($username, $filename)
    {

        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNoPermission($auth);

        if (!($auth->isManajer() || $auth->username == $username)) {
            return abort(403);
        }

        return Storage::download($username . '/' . $filename, "", [""]);
    }

    // Dirty method
    public function approval(Request $request)
    {

        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);

        $mhs_id = $request->get('mahasiswa');
        $prop_id = $request->get('proposal');
        $mnj_action = $request->get('action');

        $prop_obj = Proposal::find($prop_id);
        $mhs_obj = Mahasiswa::find($mhs_id);

        if ($auth->isManajer() && $prop_obj->mahasiswa_id == $mhs_id) {

            if ($mnj_action == Proposal::ACTION_PROPOSAL_DITERIMA) {

                $prop_obj->status = Proposal::STATUS_PROPOSAL_DITERIMA;
                $mhs_obj->status = Mahasiswa::STATUS_PROPOSAL_DITERIMA;
                $mhs_obj->t_proposal2 = date("Y-m-d H:i:s");
            } else if ($mnj_action == Proposal::ACTION_PROPOSAL_DITOLAK) {

                $prop_obj->status = Proposal::STATUS_PROPOSAL_DITOLAK;
                $mhs_obj->status = Mahasiswa::STATUS_PROPOSAL_DITOLAK;
            } else {
                return abort(400);
            }

            $prop_obj->evaluator_id = $auth->id;
            $prop_obj->save();
            $mhs_obj->save();
            return redirect('/mahasiswa/control/' . $mhs_obj->user()->username);
        } else {
            return abort(403);
        }
    }

}
