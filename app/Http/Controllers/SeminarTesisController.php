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
      if(!$usr)
          return abort(400);
        $mhs = $usr->isMahasiswa();

      if(!$mhs || !$mhs->tesis()) {
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
      $tesis = $mhs->tesis();
      if(!$usr || !$mhs || !$tesis) {
          return abort(400);
      } else {
          $db1 = $tesis->dosen_pembimbing1 == Auth::user()->id;
          $db2 = $tesis->dosen_pembimbing2 == Auth::user()->id;
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
              $tesis->judul_thesis = $judul;
              $mhs->status = Mahasiswa::STATUS_SIAP_SEMINAR_TESIS;
              $mhs->t_seminar1 = date("Y-m-d H:i:s");
              $mhs->save();
              $tesis->save();
              return redirect('/dosen/mahasiswa-control/'.$id);
          } else {
              return abort(403);
          }
      }
  }

    public function editPenjadwalan(Request $request, $id) {
        $usr = User::where('username',$id)->first();
        $mhs = $usr->isMahasiswa();
        $tesis = $mhs->tesis();
        if(!$usr || !$mhs || !$tesis) {
            return abort(400);
        } else {
            $db1 = $tesis->dosen_pembimbing1 == Auth::user()->id;
            $db2 = $tesis->dosen_pembimbing2 == Auth::user()->id;
            $st = $tesis->seminarTesis();
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
                $judul = $request->get('judul');
                $tesis->judul_thesis = $judul;
                $tesis->save();
                $st->save();
//                echo json_encode($st);
                if(Auth::user()->isManajer()) {
                    $draft = $request->get('check-draft-laporan');
                    $seminarteman = $request->get('check-seminar-dengan-teman');

                    $st->draft_laporan = isset($draft);
                    $st->sidang_dengan_teman = isset($seminarteman);
                    $st->save();
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

    public function nilaiSeminarTesis(Request $request, $id) {
        $currentUser = Auth::user();
        $usr = User::where('username',$id)->first();
//        echo $usr;
        if(!$usr)
            return abort(400);
        $mhs = $usr->isMahasiswa();
        if(!$mhs)
            return abort(400);
        $tesis = $mhs->tesis();
        if(!$tesis)
            return abort(400);
        $st =$tesis->seminarTesis();
        if(!$st)
            return abort(400);
        if($tesis->dosen_pembimbing1 == $currentUser->id) {
            $action = $request->get('action');
            $st->verdict = $action;
            $st->evaluator_id = $currentUser->id;
            $st->save();
            if($action == 1) {
                $mhs->status = Mahasiswa::STATUS_LULUS_SEMINAR_TESIS;
                $mhs->t_seminar2 = date("Y-m-d H:i:s");

            } else {
                $mhs->status = Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS;
            }
            $mhs->save();
            return back();
        } else {
            return abort(403);
        }
    }
}
