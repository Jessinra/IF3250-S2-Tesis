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
        $manajer = Auth::user()->isManajer();
        if($manajer) {
            $kelas_tesis = KelasTesis::orderBy('created_at','desc')->get();
            $dosen = Dosen::get();
            return view('manajer.kelas_tesis',['kelas_tesis' => $kelas_tesis, 'dosen' => $dosen]);
        } else {
            return abort(403);
        }
    }

    public function tambahKelasTesis(Request $request) {
        $manajer = Auth::user()->isManajer();
        if($manajer) {
            $data = $request->all();
            $ok_count = 0;

            $validator = $this->validateKelasTesis($data);
            if ($validator->fails()) {
                echo json_encode($validator->errors());
            } else {
                $ok_count++;
                $tahun = null;
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
            }

            if($ok_count==0) {
                return abort(400);
            } else {
                return redirect('/kelastesis');
            }
        } else{
            return abort (403);
        }
    }

    private function validateKelasTesis($kelas_tesis) {
        return Validator::make($kelas_tesis, [
            'tahun' => 'required|integer',
            'semester' => 'required|integer',
            'dosen_id' => 'required|integer'
        ]);
    }
}