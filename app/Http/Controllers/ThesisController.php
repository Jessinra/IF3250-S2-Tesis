<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThesisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function setDosenPembimbing1($dosbing1) {

    }

    private function setDosenPembimbing2($dosbing) {

    }

    public function handlePenetapanDosbing(Request $request) {
        echo json_encode($request->all());
    }
}
