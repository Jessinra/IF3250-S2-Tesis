<?php

namespace App\Http\Controllers;

use App\SeminarTesis;
use Illuminate\Http\Request;
use App\Mahasiswa;

use App\User;use Illuminate\Support\Facades\Auth;
class SeminarTesisController extends Controller
{
  public function requestPenjadwalan($id) {
      $usr = User::where('username',$id)->first();
      $mhs = $usr->isMahasiswa();
      if($mhs->tesis()->dosen_pembimbing1 == Auth::user()->id || $mhs->tesis()->dosen_pembimbing2 == Auth::user()->id) {
          return view('dosen.create_seminartesis',['mahasiswa'=>$mhs]);
      } else {
          return abort(403);
      }
  }
}
