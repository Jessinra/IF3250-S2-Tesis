<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\KelasTesis;
use App\Mahasiswa;
use App\Thesis;
use App\User;
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
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotDosen($auth);

        $idDosen = $auth->id;
        $idmahasiswabimbingan = Thesis::where('dosen_pembimbing1', $idDosen)->orWhere('dosen_pembimbing2', $idDosen)->pluck('mahasiswa_id');
        $mahasiswabimbingan = Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.id')
            ->whereIn('mahasiswas.id', $idmahasiswabimbingan)
            ->orderBy('users.username', 'asc')
            ->get();
        $mahasiswakelas = Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.id')
            ->where('status', '>=', 14)
            ->orderBy('users.username', 'asc')
            ->get();
        $kelas = KelasTesis::where('id_dosen_kelas', $idDosen)->get();

        return view('dosen.index', ['mahasiswabimbingan' => $mahasiswabimbingan, 'mahasiswakelas' => $mahasiswakelas, 'kelas' => $kelas]);
        
    }

    /**
     * Check is this dosen or not
     * @return boolean
     */
    public function getDosen()
    {
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
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotManager($auth);

        $dosen = $this->getDosen();
        $dosen->status = $request->get('status');
        $dosen->save();
        
        return back();
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
    public function showMahasiswa()
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotDosen($auth);

        $idDosen = $auth->id;
        $idmahasiswabimbingan = Thesis::where('dosen_pembimbing1', $idDosen)->orWhere('dosen_pembimbing2', $idDosen)->pluck('mahasiswa_id');
        $mahasiswabimbingan = Mahasiswa::whereIn('id', $idmahasiswabimbingan)->get();
        //    $idmahasiswauji = Thesis::where('dosen_penguji', $idDosen)->pluck('mahasiswa_id');
        //    $mahasiswauji = Mahasiswa::whereIn('id',$idmahasiswauji)->get();
        
        return view('dosen.index', ['mahasiswabimbingan' => $mahasiswabimbingan]);
    }

    public function detailMahasiswa($id)
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotDosen($auth);

        $user = User::where('username', $id)->get()->first();
        if (!$user) {
            return abort(400);
        }

        $mahasiswa = $user->isMahasiswa();
        if (!$mahasiswa) {
            return abort(400);
        }

        $tesisMahasiswa = $mahasiswa->tesis();
        if (!$tesisMahasiswa){
            return abort(400);
        }

        $dosen = $this->getDosen();
        $idDosen = $auth->id;
        if (!($tesisMahasiswa->dosen_pembimbing1 == $idDosen || $tesisMahasiswa->dosen_pembimbing2 == $idDosen)) {
            return abort (403);   
        }

        return view('dosen.detail_mahasiswa', ['mahasiswa' => $mahasiswa, 'user' => $user, 'dosen' => $dosen]);
    }
}
