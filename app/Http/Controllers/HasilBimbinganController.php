<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\HasilBimbingan;
use App\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function showListPersetujuanBimbingan() {
        $dosen = Auth::user()->isDosen();
        if($dosen) {
            $hsl_bimbingan = $dosen->getHasilBimbingan();
            return view('dosen.list_hasil_bimbingan_dosen',['hsl_bimbingan' => $hsl_bimbingan]);
        } else {
            return abort(403);
        }
    }

    public function showFormHasilBimbingan() {
        $mhs = Auth::user()->isMahasiswa();
        if($mhs) {
            $hsl_bimbingan = $mhs->getHasilBimbinganBelumDisetujui();
            //nanti diubah dosennya
            $dosen = Dosen::all();
            return view('mahasiswa.form_hasil_bimbingan',['hsl_bimbingan' => $hsl_bimbingan, 'dosen' => $dosen]);
        } else {
            return abort(403);
        }
    }

    public function uploadHasilBimbingan(Request $request) {
        $mahasiswa = Auth::user()->isMahasiswa();
        if($mahasiswa) {
            $user = Auth::user();
            $data = $request->all();
            $ok_count = 0;
            $db_hsl_bimbingan = HasilBimbingan::where('mahasiswa_id',$user->id)->where('status',0)->get();

            $validator = $this->validateHasilBimbingan($data);
            if ($validator->fails()) {
                echo json_encode($validator->errors());
            } else {
                $ok_count++;
                if ($db_hsl_bimbingan->count() >= $ok_count) {
                    $cur = $db_hsl_bimbingan[$ok_count - 1];
                    $cur->mahasiswa_id = $user->id;
                    $cur->dosen_id = $data['dosen_id'];
                    $cur->tanggal_waktu = $data['tanggal_waktu'];
                    $cur->topik = $data['topik'];
                    $cur->hasil_dan_diskusi = $data['hasil_dan_diskusi'];
                    $cur->rencana_tindak_lanjut = $data['rencana_tindak_lanjut'];
                    $cur->save();
                } else {
                    $hasil_bimbingan = HasilBimbingan::create([
                        'mahasiswa_id' => $user->id,
                        'dosen_id' => $data['dosen_id'],
                        'status' => 0,
                        'tanggal_waktu' => $data['tanggal_waktu'],
                        'topik' => $data['topik'],
                        'hasil_dan_diskusi' => $data['hasil_dan_diskusi'],
                        'rencana_tindak_lanjut' => $data['rencana_tindak_lanjut']
                    ]);
                }
            }

            if($ok_count==0) {
                return abort(400);
            } else {
                return redirect('/hasilbimbingan');
            }
        } else{
            return abort (403);
        }
    }

    public function persetujuan(Request $request) {
        $dosen = Auth::user()->isDosen();
        if($dosen) {
            $data = $request->all();
            $db_hsl_bimbingan = HasilBimbingan::where('id',$data['id'])->get();

            $cur = $db_hsl_bimbingan[0];
            $cur->status = $data['action'];
            $cur->save();

            return redirect('/hasilbimbingan');
        } else{
            return abort (403);
        }
    }

    private function validateHasilBimbingan($hsl_bimbingan) {
        return Validator::make($hsl_bimbingan, [
            'dosen_id' => 'required|integer',
            'tanggal_waktu' => 'required|date',
            'topik' => 'required|string|max:255',
            'hasil_dan_diskusi' => 'required|string',
            'rencana_tindak_lanjut' => 'required|string'
        ]);
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
