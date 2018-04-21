@extends('layouts.app')
@section('title')Dashboard Mahasiswa @endsection
@php
    $user = Auth::user();
    $mahasiswa = Auth::user()->isMahasiswa();
@endphp
@section('content')
    <div class="container dashboard-mahasiswa">
        <h1 class="header">Your Progress</h1>

        <div class="progress_containter">
            <div class="level_progress">
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                    <div class="progress progress_1">
                        <div class="bar done"></div>
                    </div>
                @elseif($mahasiswa->status >= \App\Mahasiswa::STATUS_TOPIK_DITERIMA ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK)
                    <div class="progress progress_1">
                        <div class="bar prog60"></div>
                    </div>
                @elseif($mahasiswa->status >= \App\Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_TOPIK_DITOLAK)
                    <div class="progress progress_1">
                        <div class="bar prog30"></div>
                    </div>
                @else
                    <div class="progress progress_1">
                        <div class="bar"></div>
                    </div>
                @endif

                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                    <div class="progress progress_2">
                        <div class="bar done"></div>
                    </div>
                @elseif($mahasiswa->status >= \App\Mahasiswa::STATUS_PROPOSAL_DITERIMA ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL)
                    <div class="progress progress_2">
                        <div class="bar prog60"></div>
                    </div>
                @elseif($mahasiswa->status >= \App\Mahasiswa::STATUS_PROPOSAL_TELAH_DIAJUKAN ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK)
                    <div class="progress progress_2">
                        <div class="bar prog30"></div>
                    </div>
                @else
                    <div class="progress progress_2">
                        <div class="bar"></div>
                    </div>
                @endif

                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SIDANG_TESIS)
                    <div class="progress progress_3">
                        <div class="bar done"></div>
                    </div>
                @elseif($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TESIS)
                    <div class="progress progress_3">
                        <div class="bar prog60"></div>
                    </div>
                @elseif($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_TESIS ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS )
                    <div class="progress progress_3">
                        <div class="bar prog30"></div>
                    </div>
                @else
                    <div class="progress progress_3">
                        <div class="bar"></div>
                    </div>
                @endif

                <div class="level level_1 level_reached"><p>1</p></div>

                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                    <div class="level level_2 level_reached"><p>2</p></div>
                @else
                    <div class="level level_2"><p>2</p></div>
                @endif

                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                    <div class="level level_3 level_reached"><p>3</p></div>
                @else
                    <div class="level level_3"><p>3</p></div>
                @endif

                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SIDANG_TESIS)
                    <div class="level level_4 level_reached"><p>4</p></div>
                @else
                    <div class="level level_4"><p>4</p></div>
                @endif

                <div class="nav" role="tablist">
                    <a class="nav-link" data-toggle="tab" href="#step1">
                        <div class="level_text level1_text">
                            <p>Seminar Topik</p>
                        </div>
                    </a>
                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK ||
                        $mahasiswa->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                        $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                        $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                        <a class="nav-link" data-toggle="tab" href="#step2">
                            <div class="level_text level2_text">
                                <p>Seminar Proposal</p>
                            </div>
                        </a>
                    @else
                        <a class="nav-link disabled" data-toggle="tab" href="#step2">
                            <div class="level_text level2_text">
                                <p>Seminar Proposal</p>
                            </div>
                        </a>
                    @endif

                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL ||
                        $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                        <a class="nav-link" data-toggle="tab" href="#step3">
                            <div class="level_text level3_text">
                                <p>Seminar Tesis</p>
                            </div>
                        </a>
                    @else
                        <a class="nav-link disabled" data-toggle="tab" href="#step3">
                            <div class="level_text level3_text">
                                <p>Seminar Tesis</p>
                            </div>
                        </a>
                    @endif

                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SIDANG_TESIS)
                        <a class="nav-link" data-toggle="tab" href="#step4">
                            <div class="level_text level4_text">
                                <p>Sidang Tesis</p>
                            </div>
                        </a>
                    @else
                        <a class="nav-link disabled" data-toggle="tab" href="#step4">
                            <div class="level_text level4_text">
                                <p>Sidang Tesis</p>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="tab-content">
        @if($mahasiswa->status < \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK)
            <div id="step1" class="container tab-pane fade active show">
        @else
            <div id="step1" class="container tab-pane fade">
        @endif
                <h3 class="header">Seminar Topik</h3>
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_TOPIK_DITOLAK ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK)
                    <br>
                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK ||
                        $mahasiswa->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                        $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                        $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                        <p>Lulus seminar topik.</p>
                    @elseif($mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK)
                        <p>Tidak lulus seminar topik.</p>
                    @endif

                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_TOPIK_DITERIMA ||
                        $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK)
                        @foreach($mahasiswa->getTopics() as $item)
                            @if($item->getStatusString() == $item->statusString[1])
                                <div class="topik-wrapper">
                                    <br>
                                    <h4>Topik Prioritas {{$loop->iteration}}</h4>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row mt-1">
                                                <span class="status-label">
                                                    Judul Tesis:&nbsp
                                                </span>
                                                <span>
                                                    {{$item->judul}}
                                                </span>
                                            </div>

                                            <div class="row mt-1">
                                                <span class="status-label">
                                                    Status:&nbsp
                                                </span>
                                                <span>
                                                    <b>{!! $item->getStatusString() !!}</b>
                                                </span>
                                            </div>

                                            <div class="row mt-1">
                                                <span>
                                                    Bidang Keilmuan:&nbsp
                                                </span>
                                                <span>
                                                    {{$item->keilmuan}}
                                                </span>
                                            </div>

                                            <div class="row mt-1">
                                                <span class="status-label">
                                                    Calon Pembimbing 1: &nbsp
                                                </span>
                                                <span>
                                                    {{$item->dosen_pembimbing1->user->name}}
                                                </span>
                                            </div>

                                            <div class="row mt-1">
                                                <span class="status-label">
                                                    Calon Pembimbing 2: &nbsp
                                                </span>
                                                <span>
                                                    @if($item->calon_pembimbing2)
                                                        {{$item->dosen_pembimbing2->user->name}}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @elseif($mahasiswa->status >= \App\Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN)
                        <p>Topik Anda telah diajukan.</p>
                        @foreach($mahasiswa->getTopics() as $item)
                            <div class="topik-wrapper">
                                <br>
                                <h4>Topik Prioritas {{$loop->iteration}}</h4>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row mt-1">
                                        <span class="status-label">
                                            Judul Tesis:&nbsp
                                        </span>
                                            <span>
                                            {{$item->judul}}
                                        </span>
                                        </div>

                                        <div class="row mt-1">
                                        <span class="status-label">
                                            Status:&nbsp
                                        </span>
                                            <span>
                                            <b>{!! $item->getStatusString() !!}</b>
                                        </span>
                                        </div>

                                        <div class="row mt-1">
                                        <span>
                                            Bidang Keilmuan:&nbsp
                                        </span>
                                            <span>
                                            {{$item->keilmuan}}
                                        </span>
                                        </div>

                                        <div class="row mt-1">
                                        <span class="status-label">
                                            Calon Pembimbing 1: &nbsp
                                        </span>
                                            <span>
                                            {{$item->dosen_pembimbing1->user->name}}
                                        </span>
                                        </div>

                                        <div class="row mt-1">
                                        <span class="status-label">
                                            Calon Pembimbing 2: &nbsp
                                        </span>
                                            <span>
                                            @if($item->calon_pembimbing2)
                                                    {{$item->dosen_pembimbing2->user->name}}
                                                @endif
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @elseif($mahasiswa->status == \App\Mahasiswa::STATUS_TOPIK_DITOLAK)
                        <p>Topik ditolak.</p>
                        <a class="btn btn-blue" href="/topik/pengajuan" role="button">Ajukan Topik</a>
                        <br>
                    @endif
                @elseif($mahasiswa->status >= \App\Mahasiswa::STATUS_MENUNGGU_TOPIK)
                    <p>Anda dapat mengajukan topik tesis.</p>
                    <a class="btn btn-blue" href="/topik/pengajuan" role="button">Ajukan Topik</a>
                @endif
            </div>
        @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK &&
            $mahasiswa->status < \App\Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL)
            <div id="step2" class="container tab-pane fade active show">
        @else
            <div id="step2" class="container tab-pane fade">
        @endif
                <h3 class="header">Seminar Proposal</h3>
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_PROPOSAL)
                    <p>Proposal telah disetujui.</p>
                    @php($seminar_proposal = $mahasiswa->seminarProposal())
                    <p>Jadwal seminar: {{$seminar_proposal->schedule}}</p>
                    @php($proposal = $mahasiswa->proposal())
                    <div class="row col-md-12 flex-wrap-nowrap proposal-container">
                        <div class="row align-items-center justify-content-start file-name  width-full">
                            <i class="material-icons">insert_drive_file</i>
                            <a href="/proposal/download/{{$proposal->path}}">{{$proposal->filename}} ({{$proposal->human_filesize()}})</a>
                            <br>
                        </div>
                    </div>

                @elseif($mahasiswa->status > \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK)
                    @php($proposal = $mahasiswa->proposal())
                    <p>{{$proposal->getStatusString()}}</p>
                    <div class="row col-md-12 flex-wrap-nowrap proposal-container">
                        <div class="row align-items-center justify-content-start file-name  width-full">
                            <i class="material-icons">insert_drive_file</i>
                            <a href="/proposal/download/{{$proposal->path}}">{{$proposal->filename}} ({{$proposal->human_filesize()}})</a>
                            <br>
                        </div>

                    </div>
                    <br>
                    <a class="btn btn-blue" href="/proposal/upload" role="button">Edit Proposal</a>
                @elseif($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK)
                    <p>Anda dapat mengunggah proposal topik tesis.</p>
                    <a class="btn btn-blue" href="/proposal/upload" role="button">Unggah Proposal</a>
                @endif
            </div>

        @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL &&
            $mahasiswa->status <= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TESIS)
            <div id="step3" class="container tab-pane fade active show">
        @else
            <div id="step3" class="container tab-pane fade">
        @endif
                <h3 class="header">Seminar Tesis</h3>
                @php($tesis = $mahasiswa->tesis())
                @if($tesis)
                <div>Dosen Pembimbing 1: {{$tesis->dosen_pembimbing_1->user->name}}</div>
                @if($tesis->dosen_pembimbing_2)
                <div>Dosen Pembimbing 2: {{$tesis->dosen_pembimbing_2->user->name}}</div>
                    @endif
                @endif
                <p>Anda dapat mengunggah hasil bimbingan setiap kali selesai bimbingan.</p>
                <a class="btn btn-blue" href="/hasilbimbingan/tambah" role="button">Entri Hasil Bimbingan</a>
                <a class="btn btn-outline-dark" href="/hasilbimbingan/mahasiswa" role="button">Lihat Hasil Bimbingan</a>

            </div>
        @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TESIS)
            <div id="step4" class="container tab-pane fade active show mt-4">
        @else
            <div id="step4" class="container tab-pane fade mt-4">
        @endif
                <h3 class="header">Sidang Tesis</h3>
                <p>Anda dapat mendaftar sidang tesis.</p>
                <a class="btn btn-blue" href="/sidangtesis/daftar" role="button">Daftar Sidang Tesis</a>
            </div>
        </div>


    <!--div class="user-section row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-color-white">{{$user->name}}</h2>
                <h3 class="text-center text-color-white">{{$user->username}}</h3>
            </div>
        </div-->
    </div>
@endsection
@section('bottomjs')
    <script>

    </script>
@endsection
