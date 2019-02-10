<?php
/**
 * Created by PhpStorm.
 * User: ROG
 * Date: 4/19/2018
 * Time: 9:21 PM
 */

namespace App\Http\Controllers;


use App\Dosen;
use App\KelasTesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KelasTesisController extends Controller
{
    public function showKelasTesis() {

        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotManager($auth);
        
        $kelas_tesis = KelasTesis::orderBy('created_at','desc')->get();
        $dosen = Dosen::get();
        return view('manajer.kelas_tesis',['kelas_tesis' => $kelas_tesis, 'dosen' => $dosen]);
    }

    public function tambahKelasTesis(Request $request) {

        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotManager($auth);

        $data = $request->all();
        $validator = $this->validateKelasTesis($data);
        if ($validator->fails()) { 
            return abort(400);
        } 

        if(idate("m") > 6){
            if($data['semester'] == 1){
                $tahun = $data['tahun'];
            }else{
                $tahun = $data['tahun']+1;
            }
        }else{
            if($data['semester'] == 1){
                $tahun = $data['tahun']-1;
            }else{
                $tahun = $data['tahun'];
            }
        }

        $kelas_tesis = KelasTesis::create([
            'tahun' => $tahun,
            'semester' => $data['semester'],
            'id_dosen_kelas' => $data['dosen_id']
        ]);
    
        return redirect('/kelastesis');
    }

    private function validateKelasTesis($kelas_tesis) {
        return Validator::make($kelas_tesis, [
            'tahun' => 'required|integer',
            'semester' => 'required|integer',
            'dosen_id' => 'required|integer'
        ]);
    }
}