<?php

namespace App\Http\Controllers;
use App\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use App\Topik;
use App\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;

class TopikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showFormPengajuan() {
        $mhs = Auth::user()->isMahasiswa();
        if($mhs) {
            $topics = $mhs->getTopiks();
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
            $db_topics = Topik::where('mahasiswa_id',$user->id)->get();
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
                        if(isset($item->calon_pembimbing2)) {
                            $cur->calon_pembimbing2 = $item->calon_pembimbing2;
                        }
                        $cur->save();
                    } else {
                        $topik = Topik::create([
                            'mahasiswa_id' => $user->id,
                            'status' => 0,
                            'prioritas' => $item->prioritas,
                            'judul' => $item->judul,
                            'calon_pembimbing1' => $item->calon_pembimbing1,
                            'keilmuan' => $item->keilmuan

                        ]);
                        if(isset($item->calon_pembimbing2)) {
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
                return redirect('/topik/status');
            }
        } else{
            return abort (403);
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
            'calon_pembimbing1' => 'required|string|max:255',
            'calon_pembimbing2' => 'nullable|string|max:255',
        ]);
    }

    public function getTopik()
    {
//        echo "obselette route";
        $mahasiswa = Auth::user()->isMahasiswa();
        if ($mahasiswa) {
            $topics =  $mahasiswa->getTopiks();
            return $topics;
        }
    }
}
