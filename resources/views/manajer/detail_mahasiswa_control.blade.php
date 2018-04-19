@extends('layouts.app')
@section('title', 'List Pengajuan Topik')


@section('content')
    @php (date_default_timezone_set('Asia/Jakarta'))
    @php($seminarTopik=$mahasiswa->seminarTopik())
    @php($seminarProposal = $mahasiswa->seminarProposal())
    @php($proposal= $mahasiswa->proposal())
    @php($tesis = $mahasiswa->tesis())
    @php($topik = $mahasiswa->getApprovedTopic())
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

                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_TESIS || $mahasiswa->status <= \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                    @php($seminarTesis = $mahasiswa->tesis()->seminarTesis())

                    <div class="control-seminar-tesis mb-4s">

                        <h3>
                            Seminar Tesis
                        </h3>
                        @if($mahasiswa->status >= \App\Mahasiswa::STATUS_MASA_BIMBINGAN)
                            <div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
                                <i class="material-icons font-size-18-px mr-4">check_circle</i>
                                <span>
                                Kelulusan Seminar Tesis telah ditetapkan oleh {{$seminarTesis->evaluator->name}}
                                    pada {{date("d M Y H:i:s", strtotime($seminarTesis->updated_at.'UTC'))}}
                                </span>
                            </div>
                            <fieldset disabled="disabled">
                                @endif
                        <div>
                            <form action="/seminartesis/edit/{{$user->username}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group row col-md-12">
                                    <label for="haritgl" class="col-md-4 col-form-label text-md-right text-center">
                                        Tanggal
                                    </label>
                                    <input type="date" id="haritgl" name="haritgl" class="col-md-8 form-control" value="{{$seminarTesis->hari}}" >
                                </div>

                                <div class="form-group row col-md-12">
                                    <label for="waktu" class="col-md-4 col-form-label text-md-right text-center">
                                        Waktu
                                    </label>
                                    <input type="time" id="haritgl" name="waktu" class="col-md-8 form-control" value="{{$seminarTesis->waktu}}">
                                </div>

                                <div class="form-group row col-md-12">
                                    <label for="tempat" class="col-md-4 col-form-label text-md-right text-center" value="{{$seminarTesis->hari}}">
                                        Tempat
                                    </label>
                                    <input type="string" id="tempat" name="tempat" class="col-md-8 form-control" value="{{$seminarTesis->tempat}}">
                                </div>
                                <div class="form-group row col-md-12">
                                    @php($db1 = $seminarTesis->tesis->dosen_pembimbing_1)
                                    <label for="tempat" class="col-md-6 col-form-label text-md-right text-center" value="{{$seminarTesis->hari}}">
                                        {{$db1->user->name}}
                                    </label>

                                        <div class="align-items-center text-md-left text-center col-md-6 display-flex">
                                            {!!$seminarTesis->getApprovalStringPembimbing1()!!}
                                        </div>

                                </div>

                                <div class="form-group row col-md-12">
                                    @php($db2 = $seminarTesis->tesis->dosen_pembimbing_2)
                                    <label for="tempat" class="col-md-6 col-form-label text-md-right text-center" value="{{$seminarTesis->hari}}">
                                        {{$db2->user->name}}
                                    </label>

                                        <div class="align-items-center text-md-left text-center col-md-6 display-flex">
                                            {!!$seminarTesis->getApprovalStringPembimbing2()!!}
                                        </div>

                                </div>
                                <div class="col-md-10 offset-md-1 mb-4">
                                <div class="form-checkbox">
                                    <input type="checkbox" class="form-check-input" id="cb1" name="check-draft-laporan"
                                        @if($seminarTesis->draft_laporan) checked @endif
                                    >
                                    <label for="cb1" class="form-check-label">
                                        Draft Laporan Tesis diserahkan ke TU paling lambat 3 hari sebelum seminar
                                    </label>
                                </div>

                                <div class="form-checkbox">
                                    <input type="checkbox" class="form-check-input" id="cb2" name="check-seminar-dengan-teman" @if($seminarTesis->seminar_dengan_teman) checked @endif>
                                    <label for="cb2" class="form-check-label"

                                    >
                                       Bukti (Fotokopi) telah seminar dengan teman diserahkan ke TU
                                    </label>
                                </div>

                                </div>
                                <div class="justify-content-center row">
                                    <button class="btn btn-primary align-items-center display-flex">
                                        <i class="material-icons pencil md-12 font-size-18-px">save</i>
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_MASA_BIMBINGAN || $mahasiswa->status < \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL )
                    @php($hasilBimbinganAktif = $mahasiswa->tesis()->getHasilBimbinganAktif())
                    <div class="control-masa-bimbingan mb-4">
                        <h3>
                            Masa Bimbingan
                        </h3>
                    </div>
                    <table class="mahasiswa-control-table width-full table table-hover">
                        <thead>
                        <tr class="text-center">
                            <th>
                                No
                            </th>
                            <th>
                                Topik
                            </th>
                            <th>
                                Waktu Bimbingan
                            </th>
                            <th>
                                Status
                            </th>
                            <th></th>
                        </tr>
                        </thead>

                        @foreach($hasilBimbinganAktif as $item)
                            <tr class="text-center">
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$item->topik}}
                                </td>
                                <td>
                                    {{$item->tanggal_waktu}}
                                </td>
                                <td>
                                    {{$item->getStatusString()}}
                                </td>

                                <td class="row">
                                    <button class="btn btn-icon display-flex justify-content-center align-items-center" data-toggle="modal" data-target="#hsl{{$loop->iteration}}">
                                        <i class="material-icons font-size-18-px">
                                            search
                                        </i>
                                    </button>

                                    <div class="modal fade" id="hsl{{$loop->iteration}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Topik: {{$item->topik}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <h5>Dosen Pembimbing: </h5>
                                                    <p>{{$item->name}}</p>
                                                    <h5>Waktu Bimbingan: </h5>
                                                    <p>{{$item->tanggal_waktu}}</p>
                                                    <h5>Hasil dan diskusi: </h5>
                                                    <p>{{$item->hasil_dan_diskusi}}</p>
                                                    <h5>Rencana tindak lanjut:</h5>
                                                    <p>{{$item->rencana_tindak_lanjut}}</p>

                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                </td>

                            </tr>
                        @endforeach
                    </table>
                @endif
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL || $mahasiswa->status < \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL )

                    <div class="control-seminar-topik mb-4">
                        <h3>
                            Penetapan Dosen Pembimbing
                        </h3>
                        @if($mahasiswa->status >= \App\Mahasiswa::STATUS_MASA_BIMBINGAN)
                            <div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
                                <i class="material-icons font-size-18-px mr-2">check_circle</i>
                                &nbsp Dosen pembimbing telah ditetapkan oleh {{$tesis->creator_admin->name}}
                                pada {{date("d M Y H:i:s", strtotime($seminarTopik->updated_at.'UTC'))}}
                            </div>
                            <fieldset disabled="disabled">
                        @endif
                            <div class="row justify-content-center">
                                <form action="{{route('dosbing-penetapan')}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="mahasiswa_id" value="{{$mahasiswa->id}}">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Topik</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" value="{{$topik->judul}}" name="judul">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Keilmuan</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" value="{{$topik->keilmuan}}" name="keilmuan">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Dosen Pembimbing 1</label>
                                        <div class="col-md-6">
                                            <select name="dosen_pembimbing_1"  class="form-control" id="">
                                                @if($tesis)
                                                     <option value="{{$tesis->dosen_pembimbing1}}" selected>
                                                         {{$tesis->dosen_pembimbing_1->user->name}}
                                                     </option>
                                                @else
                                                    @foreach(\App\Dosen::getListDosenPembimbing1() as $item)
                                                        @php($user_item = $item->user)
                                                        <option value="{{$user_item->id}}"
                                                                @if($topik->calon_pembimbing1 == $item->id)
                                                                selected
                                                                @endif
                                                        >{{$user_item->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Dosen Pembimbing 2</label>
                                        <div class="col-md-6">
                                            <select name="dosen_pembimbing_2"  class="form-control" id="">
                                                @if($tesis && $tesis->dosen_pembimbing_2)
                                                    <option value="{{$tesis->dosen_pembimbing2}}" selected>
                                                        {{$tesis->dosen_pembimbing_2->user->name}}
                                                    </option>
                                                @else
                                                    <option value=""></option>
                                                    @foreach(\App\Dosen::getListDosenPembimbing2() as $item)
                                                        @php($user_item = $item->user)
                                                        <option value="{{$user_item->id}}"
                                                                @if($topik->calon_pembimbing2 == $item->id)
                                                                selected
                                                                @endif
                                                        >{{$user_item->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                    <button class="btn btn-blue">
                                        Tetapkan
                                    </button>
                                    </div>
                                </form>
                            </div>

                    </div>
                @endif


                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_PROPOSAL || $mahasiswa->status <= \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL )
                    <div class="control-seminar-topik mb-4">
                        <h3>
                            Penilaian Seminar Proposal
                        </h3>
                        @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL)
                            <div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
                                <i class="material-icons font-size-18-px mr-2">check_circle</i>
                                &nbsp Kelulusan seminar proposal ditetapkan oleh {{$seminarTopik->evaluator->name}}
                                pada {{date("d M Y H:i:s", strtotime($seminarTopik->updated_at.'UTC'))}}

                            </div>
                            <fieldset disabled="disabled">
                                @elseif($mahasiswa->status <= \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL)
                                    <div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
                                        <i class="material-icons font-size-18-px mr-2">cancel</i>
                                        Seminar Topik dinyatakan tidak lulus oleh {{$seminarTopik->evaluator->name}}
                                        pada {{date("d M Y H:i:s", strtotime($seminarTopik->updated_at.'UTC'))}}
                                    </div>
                                @endif
                                <div class="row justify-content-center">

                                    <form action=" {{route('seminarproposal-penilaian')}}" method="post" class="width-full">
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{$mahasiswa->id}}" name="mahasiswa">
                                        <input type="hidden" value="{{$seminarProposal->id}}" name="seminartopik">
                                        <div class="form-group row width-full justify-content-center">
                                        <label for="scoreIndex" class=" col-sm-2 text-right col-form-label mr-1 ml-1">Nilai</label>
                                        <select class="form-control col-sm-2 ml-1 mr-1" name="score" id="scoreIndex"

                                        >
                                            <option value="A">A</option>
                                            <option value="AB">AB</option>
                                            <option value="B">B</option>
                                            <option value="BC">BC</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                        </select>
                                            <button  class="col-md-2 btn btn-blue ml-1 mr-1">
                                                Tetapkan
                                            </button>
                                        </div>
                                    </form>

                                </div>
                                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK)
                            </fieldset>
                        @endif
                    </div>
                @endif


                @if($mahasiswa->status >=  \App\Mahasiswa::STATUS_PROPOSAL_DITERIMA || $mahasiswa->status <= \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK)
                    <div class="control-pengajuan-proposal mb-4">
                        <h3>
                            Penetapan Seminar Proposal
                        </h3>
                        @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_PROPOSAL)
                            <div class="alert alert-success row align-items-center">
                                <i class="material-icons font-size-18-px">check_circle</i>
                                &nbsp Jadwal seminar proposal ditetapkan oleh {{$seminarProposal->creator->name}}
                                pada {{date("d M Y H:i:s", strtotime($seminarProposal->created_at.'UTC'))}}
                            </div>
                            <fieldset disabled="disabled">
                                @endif
                                <div class="row col-md-12 flex-wrap-nowrap justify-content-center">
                                    <form action="{{route('seminarproposal-penetapan')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="mahasiswa" value="{{$mahasiswa->id}}">
                                        <div class="row justify-content-center">
                                            <div>
                                                <input type="datetime-local" class="form-control" name="date"
                                                       @if($seminarProposal)
                                                       value="{{date("Y-m-d\TH:i:s", strtotime($seminarProposal->schedule))}}"
                                                        @endif
                                                >
                                            </div>
                                            <button class="btn btn-blue ml-4">
                                                Tetapkan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @if($proposal->status >= \App\Mahasiswa::STATUS_PROPOSAL_DITERIMA)
                            </fieldset>
                        @endif
                    </div>
                @endif

                <div class="control-pengajuan-proposal mb-4">
                @if($mahasiswa->status >=  \App\Mahasiswa::STATUS_PROPOSAL_TELAH_DIAJUKAN || $mahasiswa->status <= \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK)
                    @php($proposal = $mahasiswa->proposal())
                    <h3>
                        Pengajuan Proposal
                    </h3>
                    @if( $mahasiswa->status != \App\Mahasiswa::STATUS_PROPOSAL_TELAH_DIAJUKAN)
                    @if($mahasiswa->status != \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK)
                                <div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
                            <i class="material-icons font-size-18-px mr-2">check_circle</i>
                            Proposal {{$proposal->filename}} diterima oleh {{$proposal->evaluator->name}} pada
                            {{date("d M Y H:i:s", strtotime($proposal->updated_at.'UTC'))}}
                        </div>
                        <fieldset disabled="disabled">
                            @elseif($mahasiswa->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK)
                                <div class="alert alert-danger row align-items-center flex-row display-flex flex-wrap-nowrap">
                                    <i class="material-icons font-size-18-px mr-2">cancel</i>
                                    Proposal {{$proposal->filename}} ditolak oleh {{$proposal->evaluator->name}} pada
                                    {{date("d M Y H:i:s", strtotime($proposal->updated_at.'UTC'))}}
                                </div>
                            @endif
                    @endif
                    <div class="row col-md-12 flex-wrap-nowrap proposal-container">
                        <div class="row align-items-center justify-content-start file-name  width-full">
                            <i class="material-icons">insert_drive_file</i>
                            <a href="/proposal/download/{{$proposal->path}}">{{$proposal->filename}} ({{$proposal->human_filesize()}})</a>
                            <br>
                        </div>
                        <form action="{{route('proposal-penerimaan')}}" method="post" class="width-full">
                            <div class=" width-full text-right flex-wrap-nowrap">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$mahasiswa->id}}" name="mahasiswa">
                                <input type="hidden" value="{{$proposal->id}}" name="proposal">
                                <button class="btn btn-red mr-1" name="action" value="0">
                                    Tolak
                                </button>
                                <button class="btn btn-blue ml-1" name="action" value="1">
                                    Terima
                                </button>
                            </div>
                        </form>

                    </div>
                    @if($proposal->status >= \App\Mahasiswa::STATUS_PROPOSAL_DITERIMA)
                        </fieldset>
                    @endif
                </div>


                @endif
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK )
                <div class="control-seminar-topik mb-4">
                    <h3>
                        Penilaian Seminar Topik
                    </h3>
                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK)
                        <div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
                            <i class="material-icons font-size-18-px mr-2">check_circle</i>
                            &nbsp Kelulusan seminar topik ditetapkan oleh {{$seminarTopik->evaluator->name}}
                            pada {{date("d M Y H:i:s", strtotime($seminarTopik->updated_at.'UTC'))}}

                        </div>
                        <fieldset disabled="disabled">
                    @elseif($mahasiswa->status <= \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK)
                                <div class="alert alert-danger row align-items-center flex-row display-flex flex-wrap-nowrap">
                            <i class="material-icons font-size-18-px mr-2">cancel</i>
                            Seminar Topik dinyatakan tidak lulus oleh {{$seminarTopik->evaluator->name}}
                            pada {{date("d M Y H:i:s", strtotime($seminarTopik->updated_at.'UTC'))}}
                        </div>
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
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_TOPIK_DITERIMA || $mahasiswa->status < \App\Mahasiswa::STATUS_TOPIK_DITOLAK)

                    <div class="control-jadwal mb-4">
                        <h3>
                            Penetapan Jadwal Seminar Topik
                        </h3>
                        <div>
                        @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK)
                                <div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
                                    <i class="material-icons font-size-18-px mr-2">check_circle</i>
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
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN || $mahasiswa->status<=\App\Mahasiswa::STATUS_TOPIK_DITOLAK)
                    <div class="section" id="pengajuan-topik mb-4">
                        <h3>Pengajuan Topik</h3>

                        @if($mahasiswa->status != \App\Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN)
                            @php($approval = $mahasiswa->getTopicApproval())
                            @if($approval->action == App\TopicApproval::ACTION_TERIMA)
                                <div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
                                   <i class="material-icons font-size-18-px mr-2">check_circle</i>
                                   &nbsp"{{$approval->topic->judul}}" telah disetujui oleh {{$approval->manajer->user()->name}}
                                   pada {{date("d M Y H:i:s", strtotime($approval->created_at.'UTC'))}}
                               </div>
                                <fieldset disabled="disabled">
                            @elseif($approval->action == App\TopicApproval::ACTION_TOLAK)
                                        <div class="alert alert-danger row align-items-center flex-row display-flex flex-wrap-nowrap">
                                    <i class="material-icons font-size-18-px">cancel</i>
                                    Semua Topik ditolak oleh {{$approval->manajer->user()->name}}
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