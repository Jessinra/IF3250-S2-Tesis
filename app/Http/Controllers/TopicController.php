<?php

namespace App\Http\Controllers;
use App\Mahasiswa;
use App\TopicApproval;
use Illuminate\Support\Facades\Auth;
use App\Topic;
use App\Dosen;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showFormPengajuan() {
        $mhs = Auth::user()->isMahasiswa();
        if($mhs) {
            $topics = $mhs->getTopics();
            $dosen1 = Dosen::all();
            $dosen2 = Dosen::all();
            return view('mahasiswa.form_pengajuan_topik',['topics'=>$topics, 'list_pembimbing1'=>$dosen1, 'list_pembimbing2'=>$dosen2]);
        } else {
            return abort(403);
        }
    }
    public function pengajuan(Request $request) {
        $mahasiswa = Auth::user()->isMahasiswa();
        if($mahasiswa) {
            $user = Auth::user();
            $data =$request->all();
            $topics = json_decode($data['topics']);
            $ok_count = 0;
            $db_topics = Topic::where('mahasiswa_id',$user->id)->get();
            echo json_encode($topics);

            foreach( $topics as $item) {
                $validator = $this->validateTopik(get_object_vars($item));
                if($validator->fails()) {
                    echo json_encode($validator->errors());
                } else {
                    $ok_count++;
                    if($db_topics->count() >= $ok_count) {
                        $cur = $db_topics[$ok_count-1];
                        $cur->mahasiswa_id = $user->id;
                        $cur->prioritas =$item->prioritas;
                        $cur->judul= $item->judul;
                        $cur->calon_pembimbing1 = $item->calon_pembimbing1;
                        $cur->keilmuan = $item->keilmuan;
                        if(isset($item->calon_pembimbing2) && $item->calon_pembimbing2 != "") {
                            $cur->calon_pembimbing2 = $item->calon_pembimbing2;
                        }
                        $cur->save();
                    } else {
                        $topik = Topic::create([
                            'mahasiswa_id' => $user->id,
                            'status' => 0,
                            'prioritas' => $item->prioritas,
                            'judul' => $item->judul,
                            'calon_pembimbing1' => $item->calon_pembimbing1,
                            'keilmuan' => $item->keilmuan

                        ]);
                        if(isset($item->calon_pembimbing2) && $item->calon_pembimbing2 != "") {
                            $topik->calon_pembimbing2 = $item->calon_pembimbing2;
                            $topik->save();
                        }
                    }
                }

            }
            for($i = $ok_count; $i < $db_topics->count();$i++) {
                $db_topics[$i]->delete();
            }
            if($ok_count==0) {
                return abort(400);
            } else {
                $mahasiswa->status = Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN;
                $mahasiswa->save();
                return redirect('/dashboard/mahasiswa');
            }
        } else{
            return abort (403);
        }
    }

    public function approval(Request $request) {
        $manajer = Auth::user()->isManajer();
        if($manajer) {
            $id = $request->get('id');
            $uname = $request->get('mahasiswa');
            $user = User::where('username',$uname)->first();
            $mhs = $user->isMahasiswa();
            if($mhs) {
                if ($id == -1) {
                    $mhs->status = Mahasiswa::STATUS_TOPIK_DITOLAK;
                    $mhs->save();
                    foreach ($mhs->getTopics() as $item) {
                        $item->status = Topic::STATUS_DITOLAK;
                        $item->save();
                    }
                    TopicApproval::create(
                        [
                            "mahasiswa_id"=> $user->id,
                            "manajer_id" => $manajer->id,
                            "topic_id" => $id,
                            "action" => TopicApproval::ACTION_TOLAK
                        ]
                    );

                } else {
                        $topik = Topic::find($id);
                        if ($topik->mahasiswa_id != $user->id) {
                            return abort(400);
                        } else {
                            $topik->status = Topic::STATUS_DITERIMA;
                            $topik->save();
                        }
                        TopicApproval::create(
                            [
                                "mahasiswa_id"=> $user->id,
                                "manajer_id" => $manajer->id,
                                "topic_id" => $id,
                                "action" => TopicApproval::ACTION_TERIMA
                            ]
                        );

                        $mhs->status = Mahasiswa::STATUS_TOPIK_DITERIMA;
                        $mhs->save();
                }
                return redirect('/mahasiswa/control/'.$uname);

            } else {
                return abort(400);
            }
        } else {
            return abort(403);
        }
    }

    public function topikList() {
        $manajer = Auth::user()->isManajer();
        if($manajer) {
            $mahasiswa = Mahasiswa::where('status',Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN)->get();
            return view('manajer.list_topik',['mahasiswa'=>$mahasiswa]);
        } else {
            return abort(403);
        }
    }

    private function validateTopik(array $topic) {
        return Validator::make($topic, [
            'prioritas' => 'required|integer',
            'judul' => 'required|string|max:255',
            'keilmuan' => 'required|string|max:255',
            'calon_pembimbing1' => 'required|integer',
            'calon_pembimbing2' => 'nullable|integer',
        ]);
    }

    public function getTopik()
    {
//        echo "obselette route";
        $mahasiswa = Auth::user()->isMahasiswa();
        if ($mahasiswa) {
            $topics =  $mahasiswa->getTopics();
            return $topics;
        }
    }
}
