<?php

namespace App\Http\Controllers;

use App\SidangTesis;
use App\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class SidangTesisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showFormDaftarSidang(){
        $mhs = Auth::user()->isMahasiswa();
        if($mhs && $mhs->tesis() && $mhs->tesis()->sidangTesis()) {
            $user = $mhs->user();
            $thesis = $mhs->tesis();
            $sidang_tesis = $thesis->sidangTesis();
            return view('mahasiswa.daftar_sidang_tesis',['sidang_tesis' => $sidang_tesis]);
        } else {
            return abort(403);
        }
    }

    public function nilaiSidangTesis(Request $request, $id) {
        $currentUser = Auth::user();
        $usr = User::where('username',$id)->first();
        echo $usr;
        if(!$usr)
            return abort(400);
        $mhs = $usr->isMahasiswa();
        if(!$mhs)
            return abort(400);
        $tesis = $mhs->tesis();
        if(!$tesis)
            return abort(400);
        $sidangtesis = $tesis->sidangTesis();
        if(!$sidangtesis)
            return abort(400);
        else if($tesis->dosen_pembimbing1 == $currentUser->id) {
            $scoreutama = $request->get('scoreUtama');
            $scorepenting = $request->get('scorePenting');
            $scorependukung = $request->get('scorePendukung');
            $sidangtesis->nilai_dosen_pembimbing_utama = $scoreutama;
            $sidangtesis->nilai_dosen_pembimbing_pendukung = $scorependukung;
            $sidangtesis->nilai_dosen_pembimbing_penting = $scorepenting;
            $sidangtesis->save();
            return back();
        } else if($sidangtesis->dosen_penguji_1 == $currentUser->id) {
            $scoreutama = $request->get('scoreUtama');
            $scorepenting = $request->get('scorePenting');
            $scorependukung = $request->get('scorePendukung');
            $sidangtesis->nilai_dosen_penguji_1_utama = $scoreutama;
            $sidangtesis->nilai_dosen_penguji_1_pendukung = $scorependukung;
            $sidangtesis->nilai_dosen_penguji_1_penting = $scorepenting;
            $sidangtesis->save();
            return back();
        } else if($sidangtesis->dosen_penguji_2 == $currentUser->id) {
            $scoreutama = $request->get('scoreUtama');
            $scorepenting = $request->get('scorePenting');
            $scorependukung = $request->get('scorePendukung');
            $sidangtesis->nilai_dosen_penguji_2_utama = $scoreutama;
            $sidangtesis->nilai_dosen_penguji_2_pendukung = $scorependukung;
            $sidangtesis->nilai_dosen_penguji_2_penting = $scorepenting;
            $sidangtesis->save();
            return back();
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
        $dos =Auth::user()->isDosen();
        $usr= User::where('username',$id)->first();
        $mhs = $usr->isMahasiswa();
        if($dos && $mhs->tesis()->dosen_pembimbing1 == $dos->id) {
            SidangTesis::create([
                'thesis_id'=>$mhs->tesis()->id
            ]);

            return back();
        } else {
            return abort(403);
        }

    }

    public function dosenEdit(Request $request, $id){
        $usr = User::where('username',$id)->first();
//        echo $usr;
        $mhs = $usr->isMahasiswa();
        $tesis = $mhs->tesis();
        $sidang = $tesis->sidangTesis();
        if($tesis->dosen_pembimbing1 ==  Auth::user()->id || $tesis->dosen_pembimbing2 == Auth::user()->id) {
            print_r($request->all());
            $sidang->tanggal  = $request->get('haritgl');
            $sidang->jam  = $request->get('waktu');
            $sidang->tempat = $request->get('tempat');
            $sidang->ajuan_penguji1 = $request->get('usulan_penguji1');
            $sidang->ajuan_penguji2 = $request->get('usulan_penguji2');
            $sidang->ajuan_penguji3 = $request->get('usulan_penguji3');
            $sidang->save();
            return back();
        }  else{
            return abort(403);
        }
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
