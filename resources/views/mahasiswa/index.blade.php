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
                @elseif($mahasiswa->status >= \App\Mahasiswa::STATUS_TOPIK_DITERIMA)
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

                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_MENUNGGU_PROPOSAL ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                    <div class="level level_2 level_reached"><p>2</p></div>
                @else
                    <div class="level level_2"><p>2</p></div>
                @endif

                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_MASA_BIMBINGAN ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                    <div class="level level_3 level_reached"><p>2</p></div>
                @else
                    <div class="level level_3"><p>2</p></div>
                @endif

                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS)
                    <div class="level level_4 level_reached"><p>2</p></div>
                @else
                    <div class="level level_4"><p>2</p></div>
                @endif

                <div class="nav" role="tablist">
                    <a class="nav-link" data-toggle="tab" href="#step1">
                        <div class="level_text level1_text">
                            <p>Seminar Topik</p>
                        </div>
                    </a>
                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_MENUNGGU_PROPOSAL ||
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

                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_MASA_BIMBINGAN ||
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

                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS)
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
            <div id="step1" class="container tab-pane fade active show">
                <h3 class="header">Seminar Topik</h3>
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_TOPIK_DITOLAK ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS ||
                    $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK)

                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK ||
                        $mahasiswa->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                        $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                        $mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                        <p>Lulus seminar topik.</p>
                    @elseif($mahasiswa->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK)
                        <p>Tidak lulus seminar topik.</p>
                        <a class="btn btn-blue" href="/topik/pengajuan" role="button">Ajukan Topik</a>
                    @endif
                    <br>
                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_TOPIK_DITERIMA)
                        <p>Topik Anda telah disetujui.</p>
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
                                                    {{$item->dosen_pembimbing1->user()->name}}
                                                </span>
                                            </div>

                                            <div class="row mt-1">
                                                <span class="status-label">
                                                    Calon Pembimbing 2: &nbsp
                                                </span>
                                                <span>
                                                    @if($item->calon_pembimbing2)
                                                        {{$item->dosen_pembimbing2->user()->name}}
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
                                            {{$item->dosen_pembimbing1->user()->name}}
                                        </span>
                                        </div>

                                        <div class="row mt-1">
                                        <span class="status-label">
                                            Calon Pembimbing 2: &nbsp
                                        </span>
                                            <span>
                                            @if($item->calon_pembimbing2)
                                                    {{$item->dosen_pembimbing2->user()->name}}
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
            <div id="step2" class="container tab-pane fade">
                <h3 class="header">Seminar Proposal</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div id="step3" class="container tab-pane fade">
                <h3 class="header">Seminar Tesis</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
            <div id="step4" class="container tab-pane fade">
                <h3 class="header">Sidang Tesis</h3>
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
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
