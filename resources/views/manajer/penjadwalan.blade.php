@extends('layouts.app')
@section('title', 'Daftar Nilai Akhir Mahasiswa')

@section('content')
    <div class="container">
        <h3>Penjadwalan Seminar dan Sidang</h3>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#seminar-topik">Seminar Topik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#seminar-proposal">Seminar Proposal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#seminar-tesis">Seminar Tesis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#sidang-tesis">Sidang Tesis</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="seminar-topik" class="container tab-pane active">
                <form action="/penjadwalan" method="post">
                    {{csrf_field()}}
                    <div class="row justify-content-center">
                        <div class="add">
                            <button type="submit" class="btn btn-blue" id="save">Simpan</button>
                        </div>
                    </div>
                    <div class="row justify-content-center table-x">
                        <table class="mahasiswa-control-table table table-hover">
                            <thead>
                            <tr class="text-center">
                                <th>
                                    No
                                </th>
                                <th>
                                    NIM
                                </th>
                                <th>
                                    Nama
                                </th>
                                <th>
                                    Topik
                                </th>
                                <th>
                                    Waktu
                                </th>
                                <th></th>
                            </tr>
                            </thead>

                            @foreach($topik as $item)
                                <tr class="text-center">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$item->topic->mahasiswa->user()->username}}
                                    </td>
                                    <td>
                                        {{$item->topic->mahasiswa->user()->name}}
                                    </td>
                                    <td>
                                        {{$item->topic->judul}}
                                    </td>
                                    <td>
                                        <input type="hidden" id="id{{$item->topic->mahasiswa_id}}" name="id{{$item->topic->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->topic->mahasiswa_id}}">
                                        <input type="hidden" id="tp{{$item->topic->mahasiswa_id}}" name="tp{{$item->topic->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->topic_id}}">
                                        <input type="datetime-local" id="sch{{$item->topic->mahasiswa_id}}" name="sch{{$item->topic->mahasiswa_id}}" class="form-control col-lg-12 " value="">
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($seminar_topik as $item)
                                <tr class="text-center">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$item->topik->topic->mahasiswa->user()->username}}
                                    </td>
                                    <td>
                                        {{$item->topik->topic->mahasiswa->user()->name}}
                                    </td>
                                    <td>
                                        {{$item->topik->topic->judul}}
                                    </td>
                                    <td>
                                        {{$item->schedule}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </form>
            </div>
            <div id="seminar-proposal" class="container tab-pane active">

            </div>
            <div id="seminar-tesis" class="container tab-pane active">

            </div>
            <div id="sidang-tesis" class="container tab-pane active">

            </div>
        </div>
    </div>
@endsection