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
        $auth = Auth::user();
        if (!$auth){
            redirect('login');
        }

        if($auth->isManajer()) {
            return redirect('/dashboard/manajer');

        } else if($auth->isDosen()){
            return redirect('/dashboard/dosen');

        } else if($auth->isMahasiswa()) {
            return redirect('/dashboard/mahasiswa');
            
        } else {
            return abort(404);
        }
    }
}
