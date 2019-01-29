<?php
/**
 * Created by PhpStorm.
 * User: ROG
 * Date: 4/21/2018
 * Time: 1:59 PM
 */

namespace App\Http\Controllers;


use App\Mahasiswa;
use App\Proposal;
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
            $seminar_topik = SeminarTopik::join('users','users.id','=','seminar_topiks.mahasiswa_id')
                                           ->select('users.username','seminar_topiks.*')
                                           ->orderBy('users.username','asc')
                                           ->orderBy('created_at','desc')
                                           ->get();
            $topik = TopicApproval::where('action',1)->whereNotIn('topic_id', function($q){
                $q->select('topik_id')->from('seminar_topiks');
            })->get();

            $proposal = Proposal::where('status',1)->whereNotIn('id', function($q){
                $q->select('proposal_id')->from('seminar_proposals');
            })->get();
//            $proposal = Proposal::where('status',0)->whereNotIn('id', function($q){
//                $q->select('proposal_id')->from('seminar_proposals');
//            })->get();

            //error_log(count($proposal));
            $seminar_proposal = SeminarProposal::join('users','users.id','=','seminar_proposals.mahasiswa_id')
                                                 ->select('users.username','seminar_proposals.*')
                                                 ->orderBy('users.username','asc')
                                                 ->orderBy('created_at','desc')
                                                 ->get();
            $seminar_tesis = SeminarTesis::join('thesis','thesis.id','=','seminar_teses.tesis_id')
                                           ->join('users','users.id','=','thesis.mahasiswa_id')
                                           ->select('users.username','seminar_teses.*')
                                           ->orderBy('users.username','asc')
                                           ->orderBy('created_at','desc')
                                           ->get();
            $sidang_tesis = SidangTesis::join('thesis','thesis.id','=','sidang_tesis.thesis_id')
                                         ->join('users','users.id','=','thesis.mahasiswa_id')
                                         ->select('users.username','sidang_tesis.*')
                                         ->orderBy('users.username','asc')
                                         ->orderBy('created_at','desc')
                                         ->get();

            return view('manajer.penjadwalan',['topik' => $topik,
                                                    'proposal' => $proposal,
                                                    'seminar_topik' => $seminar_topik,
                                                    'seminar_proposal' => $seminar_proposal,
                                                    'seminar_tesis' => $seminar_tesis,
                                                    'sidang_tesis' => $sidang_tesis]);
        } else {
            return abort(403);
        }
    }

    public function penentuanJadwalSeminarTopikBatch(Request $request){
        $manajer= Auth::user()->isManajer();
        $data = $request->all();
        if($manajer) {
            $id = 0;
            $topik_id = 0;
            $status = 0;
            foreach ($data as $key => $value){
                if(substr($key,0,2) === 'id') {
                    $id = $value;
                }else if(substr($key,0,2) === 'tp' && substr($key,2) === $id){
                    $topik_id = $value;
                }else if(substr($key,0,3) === 'sch') {
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
                        $mahasiswa->t_topik3 = date("Y-m-d H:i:s");
                        $mahasiswa->save();
                    }
                    $status = 1;
                }
            }
            if($status === 0){
                return abort(404);
            }else{
                return redirect('/penjadwalan');
            }
        } else {
            return abort(403);
        }
    }

    public function penentuanJadwalSeminarProposalBatch(Request $request){
        $manajer= Auth::user()->isManajer();
        $data = $request->all();
        if($manajer) {
            $id = 0;
            $status = 0;
            $proposal_id = 0;
            $dosbing1 = -1;
            $dosbing2 = -1;
            $dosen_penguji = -1;
            foreach ($data as $key => $value){
                if(substr($key,0,2) === 'id') {
                    $id = $value;
                }else if(substr($key,0,2) === 'tp' && substr($key,2) === $id) {
                    $proposal_id = $value;
                    error_log($proposal_id);
                }else if(substr($key,0,2) === 'pa' && substr($key,2) === $id){
                    $dosbing1 = $value;
                }else if(substr($key,0,2) === 'pb' && substr($key,2) === $id){
                    $dosbing2 = $value;
                }else if(substr($key,0,2) === 'pg' && substr($key,2) === $id){
                    $dosen_penguji = $value;
                }else if(substr($key,0,3) === 'sch') {
                    if ($id === substr($key, 3)) {
                        $mahasiswa = Mahasiswa::find($id);
                        SeminarProposal::create(
                            [
                                "mahasiswa_id" => $id,
                                "schedule" => $request->get($key),
                                "creator_id" => $manajer->id,
                                "proposal_id" => $proposal_id,
                                "id_dosen_pembimbing_1" => $dosbing1,
                                "id_dosen_pembimbing_2" => $dosbing2,
                                "id_dosen_penguji" => $dosen_penguji
                            ]
                        );
                        $mahasiswa->status = Mahasiswa::STATUS_SIAP_SEMINAR_PROPOSAL;
                        $mahasiswa->t_proposal3 = date("Y-m-d H:i:s");
                        $mahasiswa->save();
                    }
                    $status = 1;
                }
            }
            if($status === 0){
                return abort(404);
            }else{
                return redirect('/penjadwalan');
            }
        } else {
            return abort(403);
        }
    }
}