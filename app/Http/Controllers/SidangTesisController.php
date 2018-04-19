<?php

namespace App\Http\Controllers;

use App\SidangTesis;
use App\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SidangTesisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showFormDaftarSidang(){
        $mhs = Auth::user()->isMahasiswa();
        if($mhs) {
            $user = $mhs->user();
            $thesis = $mhs->tesis();
            $sidang_tesis = SidangTesis::where('thesis_id',$thesis[0]->id)->get();
            return view('mahasiswa.daftar_sidang_tesis',['sidang_tesis' => $sidang_tesis]);
        } else {
            return abort(403);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        echo $id;

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
