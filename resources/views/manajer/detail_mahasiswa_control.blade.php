@extends('layouts.app')
@section('title', 'List Pengajuan Topik')


@section('content')
    @php (date_default_timezone_set('Asia/Jakarta'))
    @php($seminarTopik=$mahasiswa->seminarTopik())
    @php($proposal= $mahasiswa->proposal())
    <div class="container detail-mahasiswa-control-page">
        <div class="row">
            <div class="col-md-4">
                <div class="status-table">
                    <div class="row header">
                                Status Mahasiswa
                    </div>
                    <div class="content-wrapper">
                    <div class="row">
                        <span>Name:</span>
                        <span>{{$user->name}}</span>
                    </div>
                    <div class="row">
                                <span>NIM:</span>
                                <span>{{$user->username}}</span>
                    </div>
                    <div class="row">
                                <span>Email:</span>
                                <span>{{$user->email}}</span>
                    </div>
                    <div class="row">
                                <span>Phone:</span>
                                <span>{{$user->phone}}</span>
                    </div>
                    <div class="row">
                        <span> Status: </span>
                        <span> {{$mahasiswa->getStatusString()}} </span>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @if($mahasiswa->status >=  \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK)
                    @php($proposal = $mahasiswa->proposal())
                    <h3>
                        Pengajuan Proposal
                    </h3>
                    <div class="row col-md-12 flex-wrap-nowrap proposal-container">
                        <div class="row align-items-center justify-content-start file-name  width-full">
                            <i class="material-icons">insert_drive_file</i>
                            <a href="/download/{{$proposal->path}}">{{$proposal->filename}} ({{$proposal->human_filesize()}})</a>
                            <br>
                        </div>
                        <form action="{{route('seminartopik-penilaian')}}" method="post" class="width-full">
                            <div class=" width-full text-right flex-wrap-nowrap">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$mahasiswa->id}}" name="mahasiswa">
                                <input type="hidden" value="{{$seminarTopik->id}}" name="seminartopik">
                                <button class="btn btn-red mr-1" name="action" value="0">
                                    Tolak
                                </button>
                                <button class="btn btn-blue ml-1" name="action" value="1">
                                    Terima
                                </button>
                            </div>
                        </form>

                    </div>


                @endif
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK )
                <div class="control-seminar-topik mb-4">
                    <h3>
                        Penilaian Seminar Topik
                    </h3>
                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK)
                        <div class="alert alert-success row align-items-center">
                            <i class="material-icons font-size-18-px">check_circle</i>
                            &nbsp Kelulusan seminar topik ditetapkan oleh {{$seminarTopik->evaluator->name}}
                            pada {{date("d M Y H:i:s", strtotime($seminarTopik->updated_at.'UTC'))}}

                        </div>
                        <fieldset disabled="disabled">
                    @elseif($mahasiswa->status < \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK)
                    @endif
                    <div class="row justify-content-center">

                        <form action=" {{route('seminartopik-penilaian')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$mahasiswa->id}}" name="mahasiswa">
                            <input type="hidden" value="{{$seminarTopik->id}}" name="seminartopik">
                            <button class="btn btn-red mr-4 width-100" name="action" value="0">
                                Tidak Lulus
                            </button>
                            <button class="btn btn-blue ml-4 width-100" name="action" value="1">
                                Lulus
                            </button>
                        </form>

                    </div>
                            @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK)
                        </fieldset>
                    @endif
                </div>
                @endif
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_TOPIK_DITERIMA)

                    <div class="control-jadwal mb-4">
                        <h3>
                            Penetapan Jadwal Seminar Topik
                        </h3>
                        <div>
                        @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK)
                                <div class="alert alert-success row align-items-center">
                                    <i class="material-icons font-size-18-px">check_circle</i>
                                    &nbsp Jadwal seminar topik ditetapkan oleh {{$seminarTopik->creator->name}}
                                    pada {{date("d M Y H:i:s", strtotime($seminarTopik->created_at.'UTC'))}}


                                </div>
                                <fieldset disabled="disabled">
                            @endif
                            <form action="{{route('seminartopik-penetapan')}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="mahasiswa" value="{{$mahasiswa->id}}">
                                <div class="row justify-content-center">
                                    <div>
                                    <input type="datetime-local" class="form-control" name="date"
                                           @if($seminarTopik)
                                           value="{{date("Y-m-d\TH:i:s", strtotime($seminarTopik->schedule))}}"
                                           @endif
                                    >
                                    </div>
                                <button class="btn btn-blue ml-4">
                                    Tetapkan
                                </button>
                                </div>
                            </form>
                            @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK)
                                </fieldset>
                            @endif
                        </div>
                    </div>
                @endif
                @if($mahasiswa->status > 0 || $mahasiswa->status==-1)

                    <div class="section" id="pengajuan-topik mb-4">
                        <h3>Pengajuan Topik</h3>
                        @if($mahasiswa->status > 1 || $mahasiswa->status==-1)
                            @php($approval = $mahasiswa->getTopicApproval())
                            @if($approval->action == App\TopicApproval::ACTION_TERIMA)
                               <div class="alert alert-success row align-items-center">
                                   <i class="material-icons font-size-18-px">check_circle</i>
                                   &nbsp"{{$approval->topic->judul}}" telah disetujui oleh {{$approval->manajer->user()->name}}
                                   pada {{date("d M Y H:i:s", strtotime($approval->created_at.'UTC'))}}
                               </div>
                                <fieldset disabled="disabled">
                            @elseif($approval->action == App\TopicApproval::ACTION_TOLAK)
                                <div class="alert alert-danger row align-items-center">
                                    <i class="material-icons font-size-18-px">cancel</i>
                                    Semua Topic ditolak oleh {{$approval->manajer->user()->name}}
                                    pada {{date("d M Y H:i:s", strtotime($approval->created_at.'UTC'))}}
                                </div>
                            @endif
                        @endif
                        <form action="{{route('topicapproval')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="mahasiswa" value="{{$user->username}}">
                        @foreach($mahasiswa->getTopics() as $item)
                            <div class="topik-wrapper">
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

                                        <div class="row">
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
                                    <div class="col-md-4 row mt-4 mt-md-0">
                                        <div class="col-6 text-center row align-items-center flex-column justify-content-center">
                                            <div>Status</div>
                                            <div><b>{!! $item->getStatusString() !!}</b></div>
                                        </div>
                                        <div class="col-6 row align-items-center justify-content-center">
                                            <button class="btn btn-blue" value="{{$item->id}}" name="id">
                                                Terima
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        <div class="row justify-content-center">
                            <button class="btn btn-red" value="-1" name="id">
                                Tolak Semua
                            </button>
                        </div>
                        </form>
                        @if($mahasiswa->status > 1)
                            </fieldset>
                        @endif
                    </div>

                @endif
            </div>

        </div>
    </div>
@endsection