<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\HasilBimbingan;
use App\Mahasiswa;
use App\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HasilBimbinganController extends Controller
{
    public static $edit_id;

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

    public function showFormTambahHasilBimbingan() {
        $mhs = Auth::user()->isMahasiswa();
        if($mhs) {
            $user = $mhs->user();
            $hsl_bimbingan = HasilBimbingan::where('status',-2)->get();
            $thesis = Thesis::where('mahasiswa_id',$user->id)->get();

            return view('mahasiswa.form_hasil_bimbingan',['hsl_bimbingan' => $hsl_bimbingan, 'thesis' => $thesis]);
        } else {
            return abort(403);
        }
    }

    public function showFormEditHasilBimbingan() {
        $mhs = Auth::user()->isMahasiswa();
        if($mhs) {
            $user = Auth::user();
            $hsl_bimbingan = HasilBimbingan::where('id',Session::get('edit_id'))->get();
            $thesis = Thesis::where('mahasiswa_id',$user->id)->get();

            return view('mahasiswa.form_hasil_bimbingan',['hsl_bimbingan' => $hsl_bimbingan, 'thesis' => $thesis]);
        } else {
            return abort(403);
        }
    }

    public function getBimbinganID(Request $request){
        $mahasiswa = Auth::user()->isMahasiswa();
        if($mahasiswa) {
            $data = $request->all();

            if($data['id'] < 0){

                $id = -1 * $data['id'];
                DB::table('hasil_bimbingans')->where('thesis_id',$mahasiswa->tesis()->id)->where('id', $id)->delete();
                return redirect('/hasilbimbingan/mahasiswa');
            }else{
                Session::put('edit_id', $data['id']);
                return redirect('/hasilbimbingan/edit');
            }
        }else{
            return abort(403);
        }
    }

    public function editHasilBimbingan(Request $request){
        $mahasiswa = Auth::user()->isMahasiswa();
        if($mahasiswa) {
            $user = Auth::user();
            $data = $request->all();
            $ok_count = 0;

            $db_hsl_bimbingan = HasilBimbingan::where('id', $data['id'])->get();
            $item_count = count($data);

            $validator = $this->validateHasilBimbingan($data);
            if ($validator->fails()) {
                echo json_encode($validator->errors());
            } else {
                $ok_count++;
                if ($db_hsl_bimbingan->count() >= $ok_count) {
                    $cur = $db_hsl_bimbingan[$ok_count - 1];
                    $cur->dosen_id = $data['dosen_id'];
                    $cur->tanggal_waktu = $data['tanggal_waktu'];
                    $cur->topik = $data['topik'];
                    $cur->hasil_dan_diskusi = $data['hasil_dan_diskusi'];
                    $cur->rencana_tindak_lanjut = $data['rencana_tindak_lanjut'];
                    if($item_count > 8){
                        $cur->dosen_id2 = $data['dosen_id2'];
                    }
                    $cur->waktu_bimbingan_selanjutnya = $data['waktu_bimbingan_selanjutnya'];
                    $cur->save();
                }
            }

            if($ok_count==0) {
                return abort(400);
            } else {
                return redirect('/hasilbimbingan/mahasiswa');
            }
        }else{
            return abort (403);
        }
    }

    public function uploadHasilBimbinganBaru(Request $request) {
        $mahasiswa = Auth::user()->isMahasiswa();
        if($mahasiswa) {
            $user = Auth::user();
            $data = $request->all();
            $ok_count = 0;
            $tesis = $mahasiswa->tesis();
            $item_count = count($data);

            $validator = $this->validateHasilBimbingan($data);
            if ($validator->fails()) {
                echo json_encode($validator->errors());
            } else {
                $ok_count++;
                $dosen2 = null;
                if($item_count > 8){
                    $dosen2 = $data['dosen_id2'];
                }
                $hasil_bimbingan = HasilBimbingan::create([
                    'dosen_id' => $data['dosen_id'],
                    'status' => 0,
                    'tanggal_waktu' => $data['tanggal_waktu'],
                    'topik' => $data['topik'],
                    'hasil_dan_diskusi' => $data['hasil_dan_diskusi'],
                    'rencana_tindak_lanjut' => $data['rencana_tindak_lanjut'],
                    'dosen_id2' => $dosen2,
                    'waktu_bimbingan_selanjutnya' => $data['waktu_bimbingan_selanjutnya'],
                    'thesis_id' => $tesis->id
                ]);
            }

            if($ok_count==0) {
                return abort(400);
            } else {
                return redirect('/hasilbimbingan/mahasiswa');
            }
        } else{
            return abort (403);
        }
    }

    public function persetujuan(Request $request) {
        $dosen = Auth::user()->isDosen();
        if($dosen) {
            $data = $request->all();
            foreach ($data as $key => $item) {
                if($key != '_token') {
                    $db_hsl_bimbingan = HasilBimbingan::where('id', $item)->get();

                    $cur = $db_hsl_bimbingan[0];
                    $cur->status = 1;
                    $cur->save();
                }
            }
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
            'rencana_tindak_lanjut' => 'required|string',
            'dosen_id2' => 'nullable|integer',
            'waktu_bimbingan_selanjutnya' => 'required|date'
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
