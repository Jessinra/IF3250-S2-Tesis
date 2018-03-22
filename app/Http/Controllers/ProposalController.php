<?php

namespace App\Http\Controllers;

use App\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



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
                $proposal->storeAs($user->username,$proposal->getClientOriginalName());
            } else {
                return abort(400);
            }
        } else {
            return abort(403);
        }
    }
}
