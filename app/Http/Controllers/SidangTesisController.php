<?php

namespace App\Http\Controllers;

use App\KelasTesis;
use App\SidangTesis;
use App\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Mahasiswa;
use Illuminate\Support\Facades\Storage;

class SidangTesisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showFormDaftarSidang(){
        $mhs = Auth::user()->isMahasiswa();
        if($mhs && $mhs->tesis() && $mhs->tesis()->sidangTesis()) {
            $user = $mhs->user();
            $thesis = $mhs->tesis();
            $sidang_tesis = $thesis->sidangTesis();
            return view('mahasiswa.daftar_sidang_tesis',['sidang_tesis' => $sidang_tesis]);
        } else {
            return abort(403);
        }
    }

    public function nilaiSidangTesis(Request $request, $id) {
        $currentUser = Auth::user();
        $usr = User::where('username',$id)->first();
        echo $usr;
        if(!$usr)
            return abort(400);
        $mhs = $usr->isMahasiswa();
        if(!$mhs)
            return abort(400);
        $tesis = $mhs->tesis();
        if(!$tesis)
            return abort(400);
        $sidangtesis = $tesis->sidangTesis();
        //$kelas = KelasTesis::orderByRaw('updated_at - created_at DESC')->first();
        $kelas = KelasTesis::where('id_dosen_kelas',$currentUser->id);
        if(!$sidangtesis)
            return abort(400);
        else {
            if($tesis->dosen_pembimbing1 == $currentUser->id || $request->get('roledosen') == "pembimbing") {
                $scoreutama = $request->get('scoreUtama');
                $scorepenting = $request->get('scorePenting');
                $scorependukung = $request->get('scorePendukung');
                $sidangtesis->nilai_dosen_pembimbing_utama = $scoreutama;
                $sidangtesis->nilai_dosen_pembimbing_pendukung = $scorependukung;
                $sidangtesis->nilai_dosen_pembimbing_penting = $scorepenting;
                $cek_nilai_penguji_1 = !is_null($sidangtesis->nilai_dosen_penguji_1_utama) && !is_null($sidangtesis->nilai_dosen_penguji_1_penting) && !is_null($sidangtesis->nilai_dosen_penguji_1_pendukung);
                $cek_nilai_penguji_2 = !is_null($sidangtesis->nilai_dosen_penguji_2_utama) && !is_null($sidangtesis->nilai_dosen_penguji_2_penting) && !is_null($sidangtesis->nilai_dosen_penguji_2_pendukung);
                $cek_nilai_pembimbing = !is_null($sidangtesis->nilai_dosen_pembimbing_utama) && !is_null($sidangtesis->nilai_dosen_pembimbing_penting) && !is_null($sidangtesis->nilai_dosen_pembimbing_pendukung);
                $cek_nilai_kelas = !is_null($sidangtesis->nilai_dosen_kelas_utama);
                $all_score_filled = $cek_nilai_pembimbing && $cek_nilai_penguji_1 && $cek_nilai_penguji_2 && $cek_nilai_kelas;
                error_log('tes masuk');
                if ($all_score_filled) {
                    error_log('tes masuk 2');
                    $ratautama = $this->countRata2($sidangtesis->nilai_dosen_penguji_1_utama, $sidangtesis->nilai_dosen_penguji_2_utama, $sidangtesis->nilai_dosen_pembimbing_utama, $sidangtesis->nilai_dosen_kelas_utama);
                    $ratapenting = $this->countRata2($sidangtesis->nilai_dosen_penguji_1_penting, $sidangtesis->nilai_dosen_penguji_2_penting, $sidangtesis->nilai_dosen_pembimbing_penting, $sidangtesis->nilai_dosen_kelas_penting);
                    $ratapendukung = $this->countRata($sidangtesis->nilai_dosen_penguji_1_pendukung, $sidangtesis->nilai_dosen_penguji_2_pendukung, $sidangtesis->nilai_dosen_pembimbing_pendukung);
                    if ($ratautama == "L") {
                        if ($ratapenting == "L") {
                            if (($ratapendukung == "L") || ($ratapendukung=="M")) {
                                $sidangtesis->nilai = "A";
                            } else {
                                $sidangtesis->nilai = "AB";
                            }
                        } else {
                                $sidangtesis->nilai = "AB";                         
                        }
                    } else {
                        if ($ratautama == "M") {
                            if (($ratapenting == "L") || ($ratapenting=="M")) {
                                if (($ratapendukung == "L") || ($ratapendukung=="M")) {
                                    $sidangtesis->nilai = "B";
                                }
                            } else {
                                if (($ratapendukung == "L") || ($ratapendukung=="M")) {
                                    $sidangtesis->nilai = "BC";
                                } else {
                                    $sidangtesis->nilai = "C";
                                }
                            }
                        } else {
                            $sidangtesis->nilai = "E";
                        }
                    }
                }
                $sidangtesis->save();
                return back();
            } else if($sidangtesis->dosen_penguji_1 == $currentUser->id || $request->get('roledosen') == "penguji1") {
                $scoreutama = $request->get('scoreUtama');
                $scorepenting = $request->get('scorePenting');
                $scorependukung = $request->get('scorePendukung');
                $sidangtesis->nilai_dosen_penguji_1_utama = $scoreutama;
                $sidangtesis->nilai_dosen_penguji_1_pendukung = $scorependukung;
                $sidangtesis->nilai_dosen_penguji_1_penting = $scorepenting;
                $cek_nilai_penguji_1 = !is_null($sidangtesis->nilai_dosen_penguji_1_utama) && !is_null($sidangtesis->nilai_dosen_penguji_1_penting) && !is_null($sidangtesis->nilai_dosen_penguji_1_pendukung);
                $cek_nilai_penguji_2 = !is_null($sidangtesis->nilai_dosen_penguji_2_utama) && !is_null($sidangtesis->nilai_dosen_penguji_2_penting) && !is_null($sidangtesis->nilai_dosen_penguji_2_pendukung);
                $cek_nilai_pembimbing = !is_null($sidangtesis->nilai_dosen_pembimbing_utama) && !is_null($sidangtesis->nilai_dosen_pembimbing_penting) && !is_null($sidangtesis->nilai_dosen_pembimbing_pendukung);
                $cek_nilai_kelas = !is_null($sidangtesis->nilai_dosen_kelas_utama);
                $all_score_filled = $cek_nilai_pembimbing && $cek_nilai_penguji_1 && $cek_nilai_penguji_2 && $cek_nilai_kelas;
                if ($all_score_filled) {
                    $ratautama = $this->countRata2($sidangtesis->nilai_dosen_penguji_1_utama, $sidangtesis->nilai_dosen_penguji_2_utama, $sidangtesis->nilai_dosen_pembimbing_utama, $sidangtesis->nilai_dosen_kelas_utama);
                    $ratapenting = $this->countRata2($sidangtesis->nilai_dosen_penguji_1_penting, $sidangtesis->nilai_dosen_penguji_2_penting, $sidangtesis->nilai_dosen_pembimbing_penting, $sidangtesis->nilai_dosen_kelas_penting);
                    $ratapendukung = $this->countRata($sidangtesis->nilai_dosen_penguji_1_pendukung, $sidangtesis->nilai_dosen_penguji_2_pendukung, $sidangtesis->nilai_dosen_pembimbing_pendukung);
                    if ($ratautama == "L") {
                        if ($ratapenting == "L") {
                            if (($ratapendukung == "L") || ($ratapendukung=="M")) {
                                $sidangtesis->nilai = "A";
                            } else {
                                $sidangtesis->nilai = "AB";
                            }
                        } else {
                                $sidangtesis->nilai = "AB";                         
                        }
                    } else {
                        if ($ratautama == "M") {
                            if (($ratapenting == "L") || ($ratapenting=="M")) {
                                if (($ratapendukung == "L") || ($ratapendukung=="M")) {
                                    $sidangtesis->nilai = "B";
                                }
                            } else {
                                if (($ratapendukung == "L") || ($ratapendukung=="M")) {
                                    $sidangtesis->nilai = "BC";
                                } else {
                                    $sidangtesis->nilai = "C";
                                }
                            }
                        } else {
                            $sidangtesis->nilai = "E";
                        }
                    }
                }
                $sidangtesis->save();
                return back();
            } else if($sidangtesis->dosen_penguji_2 == $currentUser->id || $request->get('roledosen') == "penguji2") {
                $scoreutama = $request->get('scoreUtama');
                $scorepenting = $request->get('scorePenting');
                $scorependukung = $request->get('scorePendukung');
                $sidangtesis->nilai_dosen_penguji_2_utama = $scoreutama;
                $sidangtesis->nilai_dosen_penguji_2_pendukung = $scorependukung;
                $sidangtesis->nilai_dosen_penguji_2_penting = $scorepenting;
                $cek_nilai_penguji_1 = !is_null($sidangtesis->nilai_dosen_penguji_1_utama) && !is_null($sidangtesis->nilai_dosen_penguji_1_penting) && !is_null($sidangtesis->nilai_dosen_penguji_1_pendukung);
                $cek_nilai_penguji_2 = !is_null($sidangtesis->nilai_dosen_penguji_2_utama) && !is_null($sidangtesis->nilai_dosen_penguji_2_penting) && !is_null($sidangtesis->nilai_dosen_penguji_2_pendukung);
                $cek_nilai_pembimbing = !is_null($sidangtesis->nilai_dosen_pembimbing_utama) && !is_null($sidangtesis->nilai_dosen_pembimbing_penting) && !is_null($sidangtesis->nilai_dosen_pembimbing_pendukung);
                $cek_nilai_kelas = !is_null($sidangtesis->nilai_dosen_kelas_utama);
                $all_score_filled = $cek_nilai_pembimbing && $cek_nilai_penguji_1 && $cek_nilai_penguji_2 && $cek_nilai_kelas;
                if ($all_score_filled) {
                    $ratautama = $this->countRata2($sidangtesis->nilai_dosen_penguji_1_utama, $sidangtesis->nilai_dosen_penguji_2_utama, $sidangtesis->nilai_dosen_pembimbing_utama, $sidangtesis->nilai_dosen_kelas_utama);
                    $ratapenting = $this->countRata2($sidangtesis->nilai_dosen_penguji_1_penting, $sidangtesis->nilai_dosen_penguji_2_penting, $sidangtesis->nilai_dosen_pembimbing_penting, $sidangtesis->nilai_dosen_kelas_penting);
                    $ratapendukung = $this->countRata($sidangtesis->nilai_dosen_penguji_1_pendukung, $sidangtesis->nilai_dosen_penguji_2_pendukung, $sidangtesis->nilai_dosen_pembimbing_pendukung);
                    if ($ratautama == "L") {
                        if ($ratapenting == "L") {
                            if (($ratapendukung == "L") || ($ratapendukung == "M")) {
                                $sidangtesis->nilai = "A";
                            } else {
                                $sidangtesis->nilai = "AB";
                            }
                        } else {
                            $sidangtesis->nilai = "AB";
                        }
                    } else {
                        if ($ratautama == "M") {
                            if (($ratapenting == "L") || ($ratapenting == "M")) {
                                if (($ratapendukung == "L") || ($ratapendukung == "M")) {
                                    $sidangtesis->nilai = "B";
                                }
                            } else {
                                if (($ratapendukung == "L") || ($ratapendukung == "M")) {
                                    $sidangtesis->nilai = "BC";
                                } else {
                                    $sidangtesis->nilai = "C";
                                }
                            }
                        } else {
                            $sidangtesis->nilai = "E";
                        }
                    }
                }
                $sidangtesis->save();
                return back();
            }else if($request->get('roledosen') == "kelas" || count($kelas) > 0) {
                    $scoreutama = $request->get('scoreUtama');

                    $sidangtesis->nilai_dosen_kelas_utama = $scoreutama;

                    $cek_nilai_penguji_1 = !is_null($sidangtesis->nilai_dosen_penguji_1_utama) && !is_null($sidangtesis->nilai_dosen_penguji_1_penting) && !is_null($sidangtesis->nilai_dosen_penguji_1_pendukung);
                    $cek_nilai_penguji_2 = !is_null($sidangtesis->nilai_dosen_penguji_2_utama) && !is_null($sidangtesis->nilai_dosen_penguji_2_penting) && !is_null($sidangtesis->nilai_dosen_penguji_2_pendukung);
                    $cek_nilai_pembimbing = !is_null($sidangtesis->nilai_dosen_pembimbing_utama) && !is_null($sidangtesis->nilai_dosen_pembimbing_penting) && !is_null($sidangtesis->nilai_dosen_pembimbing_pendukung);
                    $cek_nilai_kelas = !is_null($sidangtesis->nilai_dosen_kelas_utama);
                    $all_score_filled = $cek_nilai_pembimbing && $cek_nilai_penguji_1 && $cek_nilai_penguji_2 && $cek_nilai_kelas;
                    if ($all_score_filled) {
                        $ratautama = $this->countRata2($sidangtesis->nilai_dosen_penguji_1_utama, $sidangtesis->nilai_dosen_penguji_2_utama, $sidangtesis->nilai_dosen_pembimbing_utama, $sidangtesis->nilai_dosen_kelas_utama);
                        $ratapenting = $this->countRata($sidangtesis->nilai_dosen_penguji_1_penting, $sidangtesis->nilai_dosen_penguji_2_penting, $sidangtesis->nilai_dosen_pembimbing_penting);
                        $ratapendukung = $this->countRata($sidangtesis->nilai_dosen_penguji_1_pendukung, $sidangtesis->nilai_dosen_penguji_2_pendukung, $sidangtesis->nilai_dosen_pembimbing_pendukung);
                        if ($ratautama == "L") {
                            if ($ratapenting == "L") {
                                if (($ratapendukung == "L") || ($ratapendukung=="M")) {
                                    $sidangtesis->nilai = "A";
                                } else {
                                    $sidangtesis->nilai = "AB";
                                }
                            } else {
                                $sidangtesis->nilai = "AB";
                            }
                        } else {
                            if ($ratautama == "M") {
                                if (($ratapenting == "L") || ($ratapenting=="M")) {
                                    if (($ratapendukung == "L") || ($ratapendukung=="M")) {
                                        $sidangtesis->nilai = "B";
                                    }
                                } else {
                                    if (($ratapendukung == "L") || ($ratapendukung=="M")) {
                                        $sidangtesis->nilai = "BC";
                                    } else {
                                        $sidangtesis->nilai = "C";
                                    }
                                }
                            } else {
                                $sidangtesis->nilai = "E";
                            }
                        }
                    }
                    $sidangtesis->save();

                    if(!is_null($tesis->sidangTesis()->nilai)) {
                        if ($tesis->sidangTesis()->nilai != "E") {
                            $mhs->status = Mahasiswa::STATUS_LULUS;
                            $mhs->t_lulus = date("Y-m-d H:i:s");
                            $mhs->save();
                        }
                    }

                    return back();
            } else {
                return abort(403);
            }
        }
    }

    public function resetNilaiPenguji1(Request $request, $id) {
        $manajer = Auth::User()->isManajer();
        $usr = User::where('username',$id)->first();
        echo $usr;
        if (!$manajer)
            return abort(400);
        $mhs = $usr->isMahasiswa();
        if(!$mhs)
            return abort(400);
        $tesis = $mhs->tesis();
        if(!$tesis)
            return abort(400);
        $sidangtesis = $tesis->sidangTesis();
        if(!$sidangtesis)
            return abort(400);
        else {
            $sidangtesis->nilai_dosen_penguji_1_utama = NULL;
            $sidangtesis->nilai_dosen_penguji_1_penting = NULL;
            $sidangtesis->nilai_dosen_penguji_1_pendukung = NULL;
            $sidangtesis->nilai = NULL;
            $sidangtesis->save();
            return back();
        }
    }

    public function resetNilaiPenguji2(Request $request, $id) {
        $manajer = Auth::User()->isManajer();
        $usr = User::where('username',$id)->first();
        echo $usr;
        if (!$manajer)
            return abort(400);
        $mhs = $usr->isMahasiswa();
        if(!$mhs)
            return abort(400);
        $tesis = $mhs->tesis();
        if(!$tesis)
            return abort(400);
        $sidangtesis = $tesis->sidangTesis();
        if(!$sidangtesis)
            return abort(400);
        else {
            $sidangtesis->nilai_dosen_penguji_2_utama = NULL;
            $sidangtesis->nilai_dosen_penguji_2_penting = NULL;
            $sidangtesis->nilai_dosen_penguji_2_pendukung = NULL;
            $sidangtesis->nilai = NULL;
            $sidangtesis->save();
            return back();
        }
    }
    
    public function resetNilaiPembimbing(Request $request, $id) {
        $manajer = Auth::User()->isManajer();
        $usr = User::where('username',$id)->first();
        echo $usr;
        if (!$manajer)
            return abort(400);
        $mhs = $usr->isMahasiswa();
        if(!$mhs)
            return abort(400);
        $tesis = $mhs->tesis();
        if(!$tesis)
            return abort(400);
        $sidangtesis = $tesis->sidangTesis();
        if(!$sidangtesis)
            return abort(400);
        else {
            $sidangtesis->nilai_dosen_pembimbing_utama = NULL;
            $sidangtesis->nilai_dosen_pembimbing_penting = NULL;
            $sidangtesis->nilai_dosen_pembimbing_pendukung = NULL;
            $sidangtesis->nilai = NULL;
            $sidangtesis->save();
            return back();
        }
    }

    public function resetNilaiKelas(Request $request, $id) {
        $manajer = Auth::User()->isManajer();
        $usr = User::where('username',$id)->first();
        echo $usr;
        if (!$manajer)
            return abort(400);
        $mhs = $usr->isMahasiswa();
        if(!$mhs)
            return abort(400);
        $tesis = $mhs->tesis();
        if(!$tesis)
            return abort(400);
        $sidangtesis = $tesis->sidangTesis();
        if(!$sidangtesis)
            return abort(400);
        else {
            $sidangtesis->nilai_dosen_kelas_utama = NULL;
            $sidangtesis->nilai = NULL;
            $sidangtesis->save();
            return back();
        }
    }

    private function countRata($nilai1, $nilai2, $nilai3) {
        $countArray = array();
        $count_nilai_K = 0;
        $count_nilai_L = 0;
        $count_nilai_M = 0;
        array_push($countArray, $nilai1, $nilai2, $nilai3);
        foreach($countArray as $char) {
            if ($char == "L") {
                $count_nilai_L +=1; 
            } else if ($char == "K") {
                $count_nilai_K +=1;
            } else if ($char == "M") {
                $count_nilai_M +=1;
            }
        }
        if ($count_nilai_K != 0){
            if (($count_nilai_L >= $count_nilai_K) && ($count_nilai_L >= $count_nilai_M)) {
                $max = "L";
            } else if (($count_nilai_M >= $count_nilai_K) && ($count_nilai_M >= $count_nilai_L))  {
                $max = "M";
            } else if (($count_nilai_L < $count_nilai_K) && ($count_nilai_M < $count_nilai_K)) {
                $max = "K";
            }
        } else {
            if ($count_nilai_L > $count_nilai_M) {
                $max = "L";
            } else {
                $max = "M";
            }
        }

        return $max;
    }

    private function countRata2($nilai1, $nilai2, $nilai3, $nilai4) {
        $countArray = array();
        $count_nilai_K = 0;
        $count_nilai_L = 0;
        $count_nilai_M = 0;
        array_push($countArray, $nilai1, $nilai2, $nilai3, $nilai4);
        foreach($countArray as $char) {
            if ($char == "L") {
                $count_nilai_L +=1; 
            } else if ($char == "K") {
                $count_nilai_K +=1;
            } else if ($char == "M") {
                $count_nilai_M +=1;
            }
        }
        if ($count_nilai_K != 0){
            if (($count_nilai_L >= $count_nilai_K) && ($count_nilai_L >= $count_nilai_M)){
                $max = "L";
            } else if (($count_nilai_M >= $count_nilai_K) && ($count_nilai_M >= $count_nilai_L))  {
                $max = "M";
            } else if (($count_nilai_L < $count_nilai_K) && ($count_nilai_M < $count_nilai_K)) {
                $max = "K";
            }
        } else {
            if ($count_nilai_L > $count_nilai_M) {
                $max = "L";
            } else {
                $max = "M";
            }
        }

        return $max;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $dos =Auth::user()->isDosen();
        $usr= User::where('username',$id)->first();
        $mhs = $usr->isMahasiswa();
        if($dos && $mhs->tesis()->dosen_pembimbing1 == $dos->id) {
            SidangTesis::create([
                'thesis_id'=>$mhs->tesis()->id
            ]);
            return back();
        } else {
            return abort(403);
        }

    }

    public function createUlang($id)
    {
        $dos =Auth::user()->isDosen();
        $usr= User::where('username',$id)->first();
        $mhs = $usr->isMahasiswa();
        $tesis = $mhs->tesis();
        $sidang = $tesis->sidangTesis();
        if($dos && $mhs->tesis()->dosen_pembimbing1 == $dos->id) {
            $sidang->tanggal  = NULL;
            $sidang->jam  = NULL;
            $sidang->tempat = NULL;
            $sidang->dosen_penguji_1 = NULL;
            $sidang->dosen_penguji_2 = NULL;
            $sidang->ajuan_penguji1 = NULL;
            $sidang->ajuan_penguji2 = NULL;
            $sidang->approval_penguji1 = NULL;
            $sidang->approval_penguji2 = NULL;
            $sidang->save();
            return back();
        } else {
            return abort(403);
        }

    }

    public function dosenEdit(Request $request, $id){
        $usr = User::where('username',$id)->first();
//        echo $usr;
        $mhs = $usr->isMahasiswa();
        $tesis = $mhs->tesis();
        $sidang = $tesis->sidangTesis();
        if($tesis->dosen_pembimbing1 ==  Auth::user()->id || $tesis->dosen_pembimbing2 == Auth::user()->id) {
            print_r($request->all());
            $sidang->tanggal  = $request->get('haritgl');
            $sidang->jam  = $request->get('waktu');
            $sidang->tempat = $request->get('tempat');
            $tesis->judul_thesis = $request->get('judul');
            $sidang->ajuan_penguji1 = $request->get('usulan_penguji1');
            $sidang->ajuan_penguji2 = $request->get('usulan_penguji2');
            $sidang->approval_penguji1 = false;
            $sidang->approval_penguji2 = false;
            $tesis->save();
            $sidang->save();
            return back();
        }  else{
            return abort(403);
        }
    }

    public function mahasiswaEdit(Request $request, $id){
        $user = User::where('username',$id)->first();
        $mhs = $user->isMahasiswa();
        if($mhs->id == Auth::user()->id && $mhs->tesis() && $mhs->tesis()->sidangTesis()) {
            $sidang = $mhs->tesis()->sidangTesis();
            $eval_diri = $request->file('eval_diri');
            if($eval_diri) {
                $path = $eval_diri->storeAs($user->username, $eval_diri->getClientOriginalName());
//                echo "Evaluasi Diri ".$path;

                $sidang->evaluasi_diri = $path;
            }

            $draft_makalah = $request->file('draft_makalah');
            if($draft_makalah) {
                $path = $draft_makalah->storeAs($user->username, $draft_makalah->getClientOriginalName());
//                echo "Draft Makalah ".$path;

                $sidang->draft_makalah = $path;
            }

            $laporan_tesis = $request->file('laporan_tesis');
            if($laporan_tesis) {
                $path = $laporan_tesis->storeAs($user->username, $laporan_tesis->getClientOriginalName());
//                echo "Laporan Tesis ".$path;

                $sidang->laporan_tesis = $path;
            }


            $ksm_akhir = $request->file('ksm_akhir');
            if($ksm_akhir) {
                $path = $ksm_akhir->storeAs($user->username, $ksm_akhir->getClientOriginalName());
//                echo "Ksm Akhir ".$path;
                $sidang->ksm_terakhir = $path;
            }

            $form_paper = $request->file('form_paper');
            if($form_paper) {

                $path = $form_paper->storeAs($user->username, $form_paper->getClientOriginalName());
//                echo "Form Paper ".$path;
                $sidang->submit_paper = $path;
            }

            $sidang->semester_terdaftar = $request->get('semester_daftar');

            $sidang->jadwal_seminar = $request->get('tanggal_seminar_tesis');

            $sidang->save();
            return view('mahasiswa.daftar_sidang_tesis',['success'=>true]);
        } else {
            return abort(403);
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function downloadFile($id,$filename){
        $usr = User::where('username',$id)->first();
        $cusr = Auth::user();
        if($cusr->username == $id || $usr->isMahasiswa()->tesis()->dosen_pembimbing1 == $cusr->id || $usr->isMahasiswa()->tesis()->dosen_pembimbing2 == $cusr->id || $cusr->isManajer())
        {
            return Storage::download($id.'/'.$filename);
        }
    }

    public function manajerEdit(Request $request, $id){
        $usr = User::where('username',$id)->first();
//        echo $usr;
        $mhs = $usr->isMahasiswa();
        $tesis = $mhs->tesis();
        $sidang = $tesis->sidangTesis();
        if(Auth::user()->isManajer()) {
            print_r($request->all());
            $sidang->tanggal  = $request->get('haritgl');
            $sidang->jam  = $request->get('waktu');
            $sidang->tempat = $request->get('tempat');
            $sidang->dosen_penguji_1 = $request->get('dosen_penguji1');
            $sidang->dosen_penguji_2 = $request->get('dosen_penguji2');  
            $tesis->judul_thesis = $request->get('judul');
            $tesis->save();
            $sidang->save();
            $mhs->status = Mahasiswa::STATUS_SIAP_SIDANG_TESIS;
            $mhs->t_sidang = date("Y-m-d H:i:s");
            $mhs->save();
            return back();
        }  else{
            return abort(403);
        }
    }
    public function dosenPengujiApprove(Request $request, $id) {
        $usr = Auth::user();
        $st = SidangTesis::find($id);
        if($st->ajuan_penguji1 == $usr->id) {
            $st->approval_penguji1 = true;
        } else if($st->ajuan_penguji2 == $usr->id) {
            $st->approval_penguji2 = true;
        } else if($st->ajuan_penguji3 == $usr->id) {
            $st->approval_penguji3 = true;
        } else {
            return abort(403);
        }
        $st->save();
        return back();
    }
}
