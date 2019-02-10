<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\Mahasiswa;
use App\Manajer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotManager($auth);

        return view('manajer.user_management');
    }

    public function show($username)
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNoPermission($auth);

        return view('edit_user', ['user' => $user]);
    }

    public function save(Request $request, $username)
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNoPermission($auth);

        $user->name = $request->get('name');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        
        $req_pass = $request->get('password');
        $conf_pass = $request->get('password_confirmation');

        if (!$req_pass || !$conf_pass || $req_pass != $conf_pass) {
            return view('edit_user', ['user' => $user, 'success' => false]);
        }

        $user->password = Hash::make($req_pass);
        $user->save();
        
        return view('edit_user', ['user' => $user, 'success' => true]);
    }

    public function addDosenRole(Request $request, $id)
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotManager($auth);

        Dosen::create(['id' => $id]);
        return back();
    }

    public function addMahasiswaRole(Request $request, $id)
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotManager($auth);
        
        Mahasiswa::create(['id' => $id]);
        return back();
    }

    public function addManajerRole(Request $request, $id)
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotManager($auth);

        Manajer::create(['id' => $id]);
        return back();
    }
}
