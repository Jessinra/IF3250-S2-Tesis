<?php

namespace App\Http\Controllers;

use App\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function showUploadForm() {
        return view('mahasiswa.proposal.upload')
    }
}
