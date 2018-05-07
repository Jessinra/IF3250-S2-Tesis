<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\User;
use App\Dosen;
use App\Thesis;
use App\SeminarTesis;
use App\KelasTesis;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        
        if(Auth::user()->isDosen()) {
            $iddosen = Auth::user()->id;
            $idmahasiswabimbingan = Thesis::where('dosen_pembimbing1', $iddosen)->orWhere('dosen_pembimbing2', $iddosen)->pluck('mahasiswa_id');
            $mahasiswabimbingan = Mahasiswa::whereIn('id',$idmahasiswabimbingan)->get();
            $mahasiswakelas = Mahasiswa::where('status','>=',14)->get();
            //$kelas = KelasTesis::orderByRaw('updated_at - created_at DESC')->first();
            $kelas = KelasTesis::where('id_dosen_kelas',$iddosen)->get();
            return view('dosen.index', ['mahasiswabimbingan' => $mahasiswabimbingan, 'mahasiswakelas' => $mahasiswakelas, 'kelas' =>$kelas]);
        } else {
            return abort(403);
        }
    }

    /**
     * Check is this dosen or not
     * @return boolean
     */
    public function getDosen() {
        return Auth::user()->isDosen();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if(Auth::user()->isManajer()) {
            $usr = Dosen::find($id);
            $usr->status = $request->get('status');
            $usr->save();
            return back();
        } else {
            return abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }


    /**
     * Show all mahasiswa that related with dosen
     *
     * @return \Illuminate\Http\Response
     */
    public function showMahasiswa() {
        $iddosen = Auth::user()->id;
        if($this->getDosen()) {
            $idmahasiswabimbingan = Thesis::where('dosen_pembimbing1', $iddosen)->orWhere('dosen_pembimbing2', $iddosen)->pluck('mahasiswa_id');
            $mahasiswabimbingan = Mahasiswa::whereIn('id',$idmahasiswabimbingan)->get();
//            $idmahasiswauji = Thesis::where('dosen_penguji', $iddosen)->pluck('mahasiswa_id');
//            $mahasiswauji = Mahasiswa::whereIn('id',$idmahasiswauji)->get();
         return view('dosen.index',['mahasiswabimbingan' => $mahasiswabimbingan]);
        } else {
            return abort(403);
        }
    }

    public function detailMahasiswa($id) {
        $dosen = Auth::user()->isDosen();
        $user = User::where('username',$id)->get()->first();
        if(!$user) return abort(400);
        $mhs = $user->isMahasiswa();
        if(!$mhs) return abort(400);
        if($mhs->tesis() && ($mhs->tesis()->dosen_pembimbing1 == $dosen->id || $mhs->tesis()->dosen_pembimbing2 == $dosen->id)) {
            return view('dosen.detail_mahasiswa',['mahasiswa'=>$mhs, 'user'=>$user, 'dosen'=>$dosen]);
        } else {
            return abort(403);
        }
    }
}
