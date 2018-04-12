<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Thesis;

class ThesisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function handlePenetapanDosbing(Request $request) {
        $data = array();
        $data['judul'] = $request->get('judul');
        $data['keilmuan'] = $request->get('keilmuan');
        $data['dosen_pembimbing1'] = $request->get('dosen_pembimbing_1');
        $data['dosen_pembimbing2'] = $request->get('dosen_pembimbing_2');
        $data['mahasiswa_id'] = $request->get('mahasiswa_id');
        if(!$this->validateTopik($data)->fails()) {
            Thesis::create([
                'topic'=>$data['judul'],
                'keilmuan'=>$data['keilmuan'],
                'dosen_pembimbing1'=>$data['dosen_pembimbing1'],
                'dosen_pembimbing2'=>$data['dosen_pembimbing2'],
                'mahasiswa_id'=>$data['mahasiswa_id'],
                'creator'=>Auth::user()->id
            ]);
            $mhs = Mahasiswa::find($data['mahasiswa_id']);
            $mhs->status = Mahasiswa::STATUS_MASA_BIMBINGAN;
            $mhs->save();

            return back();
        } else {
//            echo json_encode($data);
//            echo json_encode($this->validateTopik($data)->errors());
            return abort(400);
        }
    }

    private function validateTopik(array $topic) {
        return Validator::make($topic, [
            'judul' => 'required|string|max:255',
            'keilmuan' => 'required|string|max:255',
            'dosen_pembimbing1' => 'required|integer',
            'dosen_pembimbing2' => 'nullable|integer',
            'mahasiswa_id'=>'required|integer'
        ]);
    }
}
