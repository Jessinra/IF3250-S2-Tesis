<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\Mahasiswa;
use App\Topic;
use App\TopicApproval;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showFormPengajuan()
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotMahasiswa($auth);

        $topics = $this->getTopik();
        $dosen1 = Dosen::all();
        $dosen2 = Dosen::all();

        return view('mahasiswa.form_pengajuan_topik', ['topics' => $topics, 'list_pembimbing1' => $dosen1, 'list_pembimbing2' => $dosen2]);
    }

    // This method is dirty af
    public function pengajuan(Request $request)
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $mahasiswa = Auth::user()->isMahasiswa();
        
        if (!$mahasiswa) {
            return abort(403);
        }

        $user = Auth::user();
        $data = $request->all();
        $topics = json_decode($data['topics']);
        $ok_count = 0;
        $db_topics = Topic::where('mahasiswa_id', $user->id)->get();
        echo json_encode($topics);

        foreach ($topics as $item) {
            $validator = $this->validateTopik(get_object_vars($item));
            if ($validator->fails()) {
                echo json_encode($validator->errors());
            } else {
                $ok_count++;
                if ($db_topics->count() >= $ok_count) {
                    $cur = $db_topics[$ok_count - 1];
                    $cur->mahasiswa_id = $user->id;
                    $cur->prioritas = $item->prioritas;
                    $cur->judul = $item->judul;
                    $cur->calon_pembimbing1 = $item->calon_pembimbing1;
                    $cur->keilmuan = $item->keilmuan;
                    if (isset($item->calon_pembimbing2) && $item->calon_pembimbing2 != "") {
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
                        'keilmuan' => $item->keilmuan,

                    ]);
                    if (isset($item->calon_pembimbing2) && $item->calon_pembimbing2 != "") {
                        $topik->calon_pembimbing2 = $item->calon_pembimbing2;
                        $topik->save();
                    }
                }
            }

        }
        for ($i = $ok_count; $i < $db_topics->count(); $i++) {
            $db_topics[$i]->delete();
        }
        if ($ok_count == 0) {
            return abort(400);
        } else {
            $mahasiswa->status = Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN;
            $mahasiswa->t_topik1 = date("Y-m-d H:i:s");
            $mahasiswa->save();
            return redirect('/dashboard/mahasiswa');
        }
    }

    public function approval(Request $request)
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotManager($auth);
            
        // Check user existence
        $uname = $request->get('mahasiswa');
        $user = User::where('username', $uname)->first();
        if (!$user) {
            return abort(403);
        } 
        
        $mahasiswa = $user->isMahasiswa();

        // Tolak 
        $approvalID = $request->get('id');
        if ($approvalID == -1) {

            $mahasiswa->status = Mahasiswa::STATUS_TOPIK_DITOLAK;
            $mahasiswa->save();

            foreach ($mahasiswa->getTopics() as $item) {
                $item->status = Topic::STATUS_DITOLAK;
                $item->save();
            }

            TopicApproval::create(
                [
                    "mahasiswa_id" => $user->id,
                    "manajer_id" => $manajer->id,
                    "topic_id" => $approvalID,
                    "action" => TopicApproval::ACTION_TOLAK,
                ]
            );

        // Terima
        } else {

            $topik = Topic::find($approvalID);

            if ($topik->mahasiswa_id != $user->id) {
                return abort(400);
            } 
            
            $mahasiswa->status = Mahasiswa::STATUS_TOPIK_DITERIMA;
            $mahasiswa->t_topik2 = date("Y-m-d H:i:s");
            $mahasiswa->save();

            $topik->status = Topic::STATUS_DITERIMA;
            $topik->save();
            
            TopicApproval::create(
                [
                    "mahasiswa_id" => $user->id,
                    "manajer_id" => $manajer->id,
                    "topic_id" => $approvalID,
                    "action" => TopicApproval::ACTION_TERIMA,
                ]
            );
        }
        
        return redirect('/mahasiswa/control/' . $uname);
    }

    // Not Used
    public function topikList()
    {
        $auth = Auth::user();
        $this->redirectIfNotLoggedIn($auth);
        $this->redirectIfNotManager($auth);

        $mahasiswa = Mahasiswa::where('status', Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN)->get();
        return view('manajer.list_topik', ['mahasiswa' => $mahasiswa]);
    }

    private function validateTopik(array $topic)
    {
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
        $mahasiswa = Auth::user()->isMahasiswa();
        if ($mahasiswa) {
            $topics = $mahasiswa->getTopics();
            return $topics;
        }
    }
}
