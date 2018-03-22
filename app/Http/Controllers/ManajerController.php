<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getManajer() {
        return Auth::user()->isManajer();
    }
    public function index()
    {
        //
        if($this->getManajer()) {
            return view('manajer.index');
        } else {
            return abort(403);
        }
    }

    public function controlMahasiswa() {
        $manajer = $this->getManajer();
        if($manajer) {
            $mahasiswa = Mahasiswa::where('status', '!=', Mahasiswa::STATUS_NOT_ACTIVE)->get();
            return view('manajer.mahasiswa_control', ['mahasiswa' => $mahasiswa]);
        } else {
            abort(403);
        }
    }

    public function detailControlMahasiswa($username) {
        if($this->getManajer()) {
            $user = User::where('username', $username)->get()->first();
            $mahasiswa = $user->isMahasiswa();
            if ($mahasiswa) {
                $topik = $mahasiswa->getTopiks();
                return view('manajer.detail_mahasiswa_control',
                    [
                        'mahasiswa' => $mahasiswa,
                        'user' => $user,
                        'topik'=> $topik,
                    ]
                );
            } else {
                return abort(404);
            }
        } else {
            return abort(403);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
