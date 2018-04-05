<?php

namespace App\Http\Controllers;

use App\HasilBimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasilBimbinganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showListHasilBimbingan() {
        $mhs = Auth::user()->isMahasiswa();
        if($mhs) {
            $hsl_bimbingan = $mhs->getHasilBimbingan();
            return view('mahasiswa.list_hasil_bimbingan',['hsl_bimbingan' => $hsl_bimbingan]);
        } else {
            return abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HasilBimbingan  $hasilBimbingan
     * @return \Illuminate\Http\Response
     */
    public function show(HasilBimbingan $hasilBimbingan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HasilBimbingan  $hasilBimbingan
     * @return \Illuminate\Http\Response
     */
    public function edit(HasilBimbingan $hasilBimbingan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HasilBimbingan  $hasilBimbingan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HasilBimbingan $hasilBimbingan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HasilBimbingan  $hasilBimbingan
     * @return \Illuminate\Http\Response
     */
    public function destroy(HasilBimbingan $hasilBimbingan)
    {
        //
    }
}
