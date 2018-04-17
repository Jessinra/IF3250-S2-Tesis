@extends('layouts.app')
@section('title', 'List Pengajuan Topik')


@section('content')
    @php (date_default_timezone_set('Asia/Jakarta'))
    @php($seminarTopik=$mahasiswa->seminarTopik())
    @php($seminarProposal = $mahasiswa->seminarProposal())
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
                    <a href="/seminartesis/create/{{$mahasiswa->user()->username}}">
                    <button class="btn btn-blue">
                        Seminar Tesis
                    </button>
                    </a>
                </div>
            </div>
            <div class="col-md-8">
                @if($mahasiswa->status >= \App\Mahasiswa::STATUS_MASA_BIMBINGAN || $mahasiswa->status < \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL )
                    @php($hasilBimbinganAktif = $mahasiswa->getHasilBimbinganAktif())
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