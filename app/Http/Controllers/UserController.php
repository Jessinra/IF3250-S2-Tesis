<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Dosen;
use App\Manajer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    public function index() {
        return view('manajer.user_management');
    }

    public function show($uname) {
        $auth = Auth::user();
        $usr = User::where('username',$uname)->first();
        if($auth->id  == $usr->id || $auth->isManajer())  {
            return view('edit_user',['user'=>$usr]);
        } else {
            return abort(403);
        }
    }

    public function save(Request $request, $uname) {
        $auth = Auth::user();
        $usr = User::where('username',$uname)->first();
        if($auth->id  == $usr->id || $auth->isManajer())  {
            $usr->name = $request->get('name');
            $usr->phone = $request->get('phone');
            $usr->email = $request->get('email');
            $req_pass = $request->get('password');
            if($req_pass) {
                if($req_pass == $request->get('password_confirmation')) {
                    $usr->password = Hash::make($req_pass);
                }
                else {
                    return view('edit_user',['user'=>$usr,'success'=>false]);

                }
            }
            $usr->save();
            return view('edit_user',['user'=>$usr,'success'=>true]);
//            $usr->name = $request->get('name');
//            $usr->name = $request->get('name');
        } else {
            return abort(403);
        }
    }

    public function addDosenRole(Request $request, $id) {
        if(Auth::user()->isManajer()) {
            Dosen::create(['id'=>$id]);
            return back();

        } else {
            return abort(403);
        }
    }
    public function addMahasiswaRole(Request $request, $id) {
        if(Auth::user()->isManajer()) {
            Mahasiswa::create(['id'=>$id]);
            return back();
        } else {
            return abort(403);
        }
    }
    public function addManajerRole(Request $request, $id) {
        if(Auth::user()->isManajer()) {
            Manajer::create(['id'=>$id]);
            return back();

        } else {
            return abort(403);
        }
    }


}
