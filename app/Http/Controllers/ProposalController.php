<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProposalController extends Controller
{
    public function showUploadForm() {
        return view('mahasiswa.proposal.upload');
    }
    public function upload(Request $request) {
        $user = Auth::user();
        $mhs = $user->isMahasiswa();

        if($mhs) {
            $proposal = $request->file('proposal');
            if($proposal)  {
//                echo $proposal->getClientOriginalName();
//                echo "<br>";
//                echo $proposal->getSize();
//                echo "<br>";
//                echo $proposal->getClientSize();
//                echo "<br>";
//
                $path = $proposal->storeAs($user->username,$proposal->getClientOriginalName());
                Proposal::create([
                    "mahasiswa_id"=> $mhs->id,
                    "filesize"=>$proposal->getSize(),
                    "filename"=>$proposal->getClientOriginalName(),
                    "path" => $path
                ]);
                $mhs->status = Mahasiswa::STATUS_PROPOSAL_TELAH_DIAJUKAN;
                $mhs->save();
                return redirect("/");
            } else {
                return abort(400);
            }
        } else {
            return abort(403);
        }
    }
    public function download(Request $request) {
        $usr = Auth::user();
        $mhs_id = $request->get('mahasiswa');
        $mhs  = Mahasiswa::find($mhs_id);
        if($usr->isManajer() || $usr->id == $mhs_id) {
            return Storage::download($mhs->proposal()->path);
        }
    }

}
