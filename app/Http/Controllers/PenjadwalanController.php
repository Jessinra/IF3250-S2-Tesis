<?php
/**
 * Created by PhpStorm.
 * User: ROG
 * Date: 4/21/2018
 * Time: 1:59 PM
 */

namespace App\Http\Controllers;


use App\Mahasiswa;
use App\SeminarProposal;
use App\SeminarTesis;
use App\SeminarTopik;
use App\SidangTesis;
use App\Topic;
use App\TopicApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjadwalanController extends Controller
{
    public function showPenjadwalanPage(){
        $manajer = Auth::user()->isManajer();
        if($manajer) {
            $seminar_topik = SeminarTopik::get();
            $topik = TopicApproval::where('action',1)->whereNotIn('topic_id', function($q){
                $q->select('topik_id')->from('seminar_topiks');
            })->get();

            $seminar_proposal = SeminarProposal::get();
            $seminar_tesis = SeminarTesis::get();
            $sidang_tesis = SidangTesis::get();

            return view('manajer.penjadwalan',['topik' => $topik,
                                                    'seminar_topik' => $seminar_topik,
                                                    'seminar_proposal' => $seminar_proposal,
                                                    'seminar_tesis' => $seminar_tesis,
                                                    'sidang_tesis' => $sidang_tesis]);
        } else {
            return abort(403);
        }
    }

    public function penentuanJadwalBatch(Request $request){
        $manajer= Auth::user()->isManajer();
        $data = $request->all();
        if($manajer) {
            $id = 0;
            $topik_id = 0;
            $status = 0;
            foreach ($data as $key => $value){
                error_log('key: '.$key.' val: '.$value.' mhs id: '.$id);

                if(substr($key,0,2) === 'id') {
                    $id = $value;
                }else if(substr($key,0,2) === 'tp' && substr($key,2) === $id){
                    $topik_id = $value;
                }else if(substr($key,0,3) === 'sch') {
                    error_log('tes');
                    if ($id === substr($key, 3)) {
                        $mahasiswa = Mahasiswa::find($id);
                        SeminarTopik::create(
                            [
                                "mahasiswa_id" => $id,
                                "schedule" => $request->get($key),
                                "creator_id" => $manajer->id,
                                "topik_id" => $topik_id
                            ]
                        );
                        $mahasiswa->status = Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK;
                        $mahasiswa->save();
                        error_log('success');
                    }
                    $status = 1;
                }
            }
            if($status === 0){
                return abort(404);
            }else{
                return redirect('/penjadwalan');
            }


//            if($mahasiswa) {
//                SeminarTopik::create(
//                    [
//                        "mahasiswa_id" => $mhs_id,
//                        "schedule" => $request->get("date"),
//                        "creator_id" => $manajer->id
//                    ]
//                );
//                $mahasiswa->status = Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK;
//                $mahasiswa->save();
//                return redirect('/mahasiswa/control/'.$mahasiswa->user()->username);
//            } else {
//                return abort(400);
//            }

        } else {
            return abort(403);
        }
    }
}