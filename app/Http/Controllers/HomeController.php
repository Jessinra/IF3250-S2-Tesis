<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()) {
            $user = Auth::user();
            if($user->isManajer()) {
                return redirect('/dashboard/manajer');
            } else if($user->isDosen()){
                return redirect('/dashboard/dosen');
            } else if($user->isMahasiswa()) {
                return redirect('/dashboard/mahasiswa');
            } else {
                return abort(404);
            }
        } else {
            redirect('login');
        }
    }
}
