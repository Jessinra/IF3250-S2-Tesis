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
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotManager($auth);
        
        return view('manajer.index');
    }

    public function controlMahasiswa() {
        
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotManager($auth);

        $mahasiswa = Mahasiswa::join('users','users.id','=','mahasiswas.id')
                                ->select('users.username','mahasiswas.*')
                                ->where('status', '!=', Mahasiswa::STATUS_NOT_ACTIVE)
                                ->where('status', '!=', Mahasiswa::STATUS_LULUS)
                                ->orderBy('users.username','asc')
                                ->get();

        return view('manajer.mahasiswa_control', ['mahasiswa' => $mahasiswa]);
      
    }

    public function detailControlMahasiswa($username) {

        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotManager($auth);

        $user = User::where('username', $username)->get()->first();
        if (!$user){
            return abort(404);
        }

        $mahasiswa = $user->isMahasiswa();
        if (!($user->isMahasiswa())){
            return abort(404);
        }

        return view('manajer.detail_mahasiswa_control',
            [
                'mahasiswa' => $mahasiswa,
                'user' => $user,
            ]
        );
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
