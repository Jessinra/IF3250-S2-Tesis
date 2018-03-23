@extends('layouts.app')
@section('title', 'List Pengajuan Topik')


@section('content')
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
                @if($mahasiswa->status > 1)
                    <div class="control-jadwal">
                        <h3>
                            Penetapan Jadwal Seminar Topik
                        </h3>

                    </div>
                @endif
                @if($mahasiswa->status > 0)
                    @if($mahasiswa->status > 1)
                        <fieldset disabled="disabled">
                        @endif
                    <div class="section" id="pengajuan-topik">
                        <h3>Pengajuan Topik</h3>
                        @foreach($mahasiswa->getTopiks() as $item)
                            <div class="topik-wrapper">
                            <h4>Topik Prioritas {{$loop->iteration}}</h4>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <span>
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

                                        <div class="row">
                                            <span>
                                                Calon Pembimbing 1: &nbsp
                                            </span>
                                            <span>
                                                {{$item->dosen_pembimbing1->user()->name}}
                                            </span>
                                        </div>
                                        <div class="row">
                                            <span>
                                                Calon Pembimbing 2: &nbsp
                                            </span>
                                            <span>
                                                @if($item->calon_pembimbing2)
                                                    {{$item->dosen_pembimbing2->user()->name}}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 row">
                                        <div class="col-6 text-center">
                                            <div>Status</div>
                                            <div><b>{!! $item->getStatusString() !!}</b></div>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-blue">
                                                Terima
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        <div class="row justify-content-center">
                            <button class="btn btn-red">
                                Tolak Semua
                            </button>
                        </div>

                    </div>
                    @if($mahasiswa->status > 1)
                        </fieldset>
                    @endif
                @endif
            </div>

        </div>
    </div>
@endsection