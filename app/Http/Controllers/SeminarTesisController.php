<?php

namespace App\Http\Controllers;

use App\SeminarTesis;
use Illuminate\Http\Request;
use App\Mahasiswa;

use App\User;use Illuminate\Support\Facades\Auth;

class SeminarTesisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

  public function requestPenjadwalan($id) {
      $usr = User::where('username',$id)->first();
      $mhs = $usr->isMahasiswa();
      if(!$usr || !$mhs || !$mhs->tesis()) {
          return abort(400);
      } else {
          if ($mhs->tesis()->dosen_pembimbing1 == Auth::user()->id || $mhs->tesis()->dosen_pembimbing2 == Auth::user()->id) {
              return view('dosen.create_seminartesis', ['mahasiswa' => $mhs]);
          } else {
              return abort(403);
          }
      }
  }

  public function createRequestPenjadwalan(Request $request, $id) {
      $usr = User::where('username',$id)->first();
      $mhs = $usr->isMahasiswa();
      if(!$usr || !$mhs || !$mhs->tesis()) {
          return abort(400);
      } else {
          $db1 = $mhs->tesis()->dosen_pembimbing1 == Auth::user()->id;
          $db2 = $mhs->tesis()->dosen_pembimbing2 == Auth::user()->id;
          if ($db1 || $db2) {
              $name = $request->get('name');
              $nim = $request->get('nim');
              $judul = $request->get('judul');
              $hari = $request->get('haritgl');
              $waktu = $request->get('waktu');
              $tempat = $request->get('tempat');
              $st = SeminarTesis::create([
                  'tesis_id' => $mhs->tesis()->id,
                  'issuer_id' => Auth::user()->id,
                  'hari' => $hari,
                  'waktu'=> $waktu,
                  'tempat' => $tempat,
                  'approval_pembimbing1' => $db1,
                  'approval_pembimbing2' => $db2,
              ]);
              $mhs->status = Mahasiswa::STATUS_SIAP_SEMINAR_TESIS;
              $mhs->save();
              return redirect('/dosen/mahasiswa-control/'.$id);
          } else {
              return abort(403);
          }
      }
  }

    public function editPenjadwalan(Request $request, $id) {
        $usr = User::where('username',$id)->first();
        $mhs = $usr->isMahasiswa();
        if(!$usr || !$mhs || !$mhs->tesis()) {
            return abort(400);
        } else {
            $db1 = $mhs->tesis()->dosen_pembimbing1 == Auth::user()->id;
            $db2 = $mhs->tesis()->dosen_pembimbing2 == Auth::user()->id;
            $st = $mhs->tesis()->seminarTesis();
            if ($db1 || $db2 || Auth::user()->isManajer())  {
                echo json_encode($request->all());
                if($request->get('approval_db2') && $db2) {
                    $st->approval_pembimbing2 = true;
                }
                if($request->get('approval_db1') && $db1) {
                    $st->approval_pembimbing1 = true;
                }
                $st->waktu = $request->get('waktu');
                $st->hari = $request->get('haritgl');
                $st->tempat = $request->get('tempat');
                $st->save();
//                echo json_encode($st);
                if(Auth::user()->isManajer()) {
                    $draft = $request->get('check-draft-laporan');
                    $seminarteman = $request->get('check-seminar-dengan-teman');

                }
                if($db1 || $db2) {
                    return redirect('/dosen/mahasiswa-control/' . $id);
                } else {
                    return redirect('/mahasiswa/control/'.$id);
                }
            } else {
                return abort(403);
            }
        }
    }
}
