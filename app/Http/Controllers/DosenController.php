<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Thesis;
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
            return view('dosen.index');
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
    public function edit(Mahasiswa $mahasiswa)
    {
        //
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
            $idmahasiswa = Thesis::where('dosen_pembimbing1', $iddosen)->pluck('mahasiswa_id');
            $mahasiswa = Mahasiswa::whereIn('id',$idmahasiswa)->get();
         return view('dosen.listmahasiswa',['mahasiswa' => $mahasiswa]);
        } else {
            return abort(403);
        }
    }
}
