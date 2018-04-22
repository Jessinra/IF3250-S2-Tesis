@extends('layouts.app')
@section('title', 'List Pengajuan Topik')


@section('content')
    @php (date_default_timezone_set('Asia/Jakarta'))
    @php($seminarTopik=$mahasiswa->seminarTopik())
    @php($seminarProposal = $mahasiswa->seminarProposal())
    @php($tesis = $mahasiswa->tesis())
    @php($seminarTesis = $tesis->seminarTesis())
    @php($sidangTesis = $tesis->sidangTesis())

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
                <div class="row mt-3 justify-content-center ">
                    <a href="/seminartesis/create/{{$mahasiswa->user()->username}}"class="mb-4">
                    <button class="btn btn-blue">
                        Buat Pengajuan Seminar Tesis
                    </button>
                    </a>
                    @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TESIS)
                        <a href="/sidangtesis/create/{{$mahasiswa->user()->username}}" class="mb-4">
                            <button class="btn btn-blue">
                                Buat Pengajuan Sidang Tesis
                            </button>
                        </a>
                    @endif
                </div>

            </div>

            <div class="col-md-8">
            @if (!is_null($sidangTesis->waktu))
                    <div class="mb-2">
                        <h3>
                            Penilaian Sidang Tesis
                        </h3>
                        @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS)
                            <div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
                                <i class="material-icons font-size-18-px mr-2">check_circle</i>
                                &nbsp Kelulusan mahasiswa ditetapkan pada {{date("d M Y H:i:s", strtotime($sidangTopik->updated_at.'UTC'))}}

                            </div>
                            @endif
                                <div class="row justify-content-center">

                                    <form action="/sidangtesis/nilai/{{$user->username}}" method="post" class="width-full">
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{$user->username}}" name="mahasiswa">
                                        <div class="form-group row width-full justify-content-center">
                                            <label for="scoreIndexUtama" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Utama</label>
                                            <select class="form-control col-sm-2 ml-1 mr-1" name="scoreUtama" id="scoreIndexUtama"
                                            >
                                                <option value="L">L</option>
                                                <option value="M">M</option>
                                                <option value="K">K</option>
                                            </select>
                                        </div>
                                        <div class="form-group row width-full justify-content-center">
                                            <label for="scoreIndexPenting" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Penting</label>
                                            <select class="form-control col-sm-2 ml-1 mr-1" name="scorePenting" id="scoreIndexPenting"
                                            >
                                                <option value="L">L</option>
                                                <option value="M">M</option>
                                                <option value="K">K</option>
                                            </select>
                                        </div>
                                        <div class="form-group row width-full justify-content-center">
                                            <label for="scoreIndexPendukung" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Pendukung</label>
                                            <select class="form-control col-sm-2 ml-1 mr-1" name="scorePendukung" id="scoreIndexPendukung"
                                            >
                                                <option value="L">L</option>
                                                <option value="M">M</option>
                                                <option value="K">K</option>
                                            </select>
                                        </div>
                                        <div class="form-group row width-full justify-content-center">
                                            <button  class="col-md-2 btn btn-blue ml-1 mr-1">
                                                    Tetapkan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                    </div>
                @endif
                @if($tesis->sidangTesis())
                    <div class="mb-2">
                        <h3>
                            Sidang Tesis
                        </h3>
                        <div>
                            <form action="/sidangtesis/dosen/edit/{{$user->username}}" method="post" id="form-hsl-bimbingan" >
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div class="form-group row col-md-12">
                                        <label for="name" class="col-md-4 col-form-label text-md-right text-center ">Nama<sup>*</sup></label>
                                        <input type="text" name="name" id="name" class="col-md-8 form-control"  value="{{$user->name}}" required disabled>
                                    </div>
                                    <div class="form-group row col-md-12">
                                        <label for="nim" class="col-md-4 col-form-label text-md-right text-center">NIM<sup>*</sup></label>
                                        <input type="text" name="nim" id="nim" class="col-md-8 form-control" value="{{$user->username}}" required disabled>
                                    </div>
                                    <div class="form-group row col-md-12">
                                        <label for="nim" class="col-md-4 col-form-label text-md-right text-center">Opsi<sup>*</sup></label>
                                        <input type="text" name="nim" id="nim" class="col-md-8 form-control" value="{{$tesis->keilmuan}}" required disabled>
                                    </div>

                                    <div class="form-group row col-md-12">
                                        <label for="judul" class="col-md-4 col-form-label text-md-right text-center ">Judul Tesis<sup>*</sup></label>
                                        <input type="text" id="judul" name="judul" class="col-md-8 form-control" value="{{$mahasiswa->tesis()->topic}}" required disabled>
                                    </div>



                                    <div class="form-group row col-md-12">
                                        <label for="haritgl" class="col-md-4 col-form-label text-md-right text-center">
                                            Tanggal
                                        </label>
                                        <input type="date" id="haritgl" name="haritgl" class="col-md-8 form-control" value="{{$sidangTesis->tanggal}}" >
                                    </div>

                                    <div class="form-group row col-md-12">
                                        <label for="waktu" class="col-md-4 col-form-label text-md-right text-center">
                                            Waktu
                                        </label>
                                        <input type="time" id="haritgl" name="waktu" class="col-md-8 form-control" value="{{$sidangTesis->jam}}">
                                    </div>

                                    <div class="form-group row col-md-12">
                                        <label for="tempat" class="col-md-4 col-form-label text-md-right text-center">
                                            Tempat
                                        </label>
                                        <input type="string" id="tempat" name="tempat" class="col-md-8 form-control" value="{{$sidangTesis->tempat}}">
                                    </div>

                                    <div class="form-group row col-md-12">
                                        <label for="tempat" class="col-md-4 col-form-label text-md-right text-center">
                                            Usulan Dosen Penguji
                                        </label>
                                        <select name="usulan_penguji1"  class="form-control col-md-8" id="">
                                            @foreach(App\Dosen::getListDosenPenguji() as $item)
                                                <option value="{{$item->id}}"
                                                        @if($sidangTesis->ajuan_penguji1 == $item->id)
                                                        selected
                                                        @endif
                                                >
                                                    {{$item->user->name}}

                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group row col-md-12">

                                    <label for="tempat" class="col-md-4 col-form-label text-md-right text-center">
                                            Usulan Dosen Penguji
                                        </label>
                                        <select name="usulan_penguji2"  class="form-control col-md-8" id="">
                                            @foreach(App\Dosen::getListDosenPenguji() as $item)
                                                <option value="{{$item->id}}"
                                                        @if($sidangTesis->ajuan_penguji2 == $item->id)
                                                        selected
                                                        @endif
                                                >
                                                    {{$item->user->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group row col-md-12">

                                    <label for="tempat" class="col-md-4 col-form-label text-md-right text-center">
                                            Usulan Dosen Penguji
                                        </label>
                                        <select name="usulan_penguji3"  class="form-control col-md-8" id="">
                                            @foreach(App\Dosen::getListDosenPenguji() as $item)
                                                <option value="{{$item->id}}"
                                                        @if($sidangTesis->ajuan_penguji3 == $item->id)
                                                        selected
                                                        @endif
                                                >
                                                    {{$item->user->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="row justify-content-center">
                                <button class="btn btn-blue display-flex align-items-center ">
                                    <i class="material-icons font-size-18-px">
                                        edit
                                    </i>
                                    Edit
                                </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
                @if($seminarTesis)
                @if($seminarTesis->tesis->dosen_pembimbing1 == Auth::user()->id && $seminarTesis->approval_pembimbing1 && ($seminarTesis->approval_pembimbing2 || !$tesis->dosen_pembimbing2))
                    <div class="mb-2">
                        <h3>
                            Penilaian Seminar Tesis
                        </h3>
                        @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TESIS)
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
                            <form action="/seminartesis/nilai/{{$user->username}}" method="post" class="width-full justify-content-center display-flex">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$user->username}}" name="_mahasiswa_id">
                                <button class="btn btn-red col-md-3 mr-1" name="action" value="-1">
                                    Tidak Lulus
                                </button>
                                <button class="btn btn-blue col-md-3 ml-1" name="action" value="1">
                                    Lulus
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
                @endif
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_TESIS)

                        <div class="control-seminar-tesis mb-2">
                        <h3>
                            Seminar Tesis
                        </h3>
                            @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TESIS)
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
                                    @if($db1->id == Auth::user()->id && !$seminarTesis->approval_pembimbing1)
                                        <button class="btn btn-blue" name="approval_db1" value="1">
                                            Setujui
                                        </button>
                                    @else
                                        <div class="align-items-center text-md-left text-center col-md-6 display-flex">
                                            {!!$seminarTesis->getApprovalStringPembimbing1()!!}
                                        </div>
                                    @endif

                                </div>

                                <div class="form-group row col-md-12">
                                    @php($db2 = $seminarTesis->tesis->dosen_pembimbing_2)
                                    @if($db2)
                                    <label for="tempat" class="col-md-6 col-form-label text-md-right text-center" value="{{$seminarTesis->hari}}">
                                        {{$db2->user->name}}
                                    </label>
                                    @if($db2->id == Auth::user()->id && !$seminarTesis->approval_pembimbing2)
                                        <button class="btn btn-blue" name="approval_db2" value="1">
                                            Setujui
                                        </button>
                                    @else
                                        <div class="align-items-center text-md-left text-center col-md-6 display-flex">
                                            {!!$seminarTesis->getApprovalStringPembimbing2()!!}
                                        </div>
                                    @endif
                                    @endif


                                </div>



                                <div class="justify-content-center row">
                                <button class="btn btn-primary align-items-center display-flex">
                                    <i class="material-icons pencil md-12 font-size-18-px">save</i>
                                    Save
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
                            Bimbingan
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
        </div>
    </div>
@endsection