@extends('layouts.app')
@section('title', 'Dosen')


@section('content')
    <div class="container">
        <ul class="nav nav-tabs" id="listmahasiswa-Tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mahasiswa-bimbingan-tab" data-toggle="tab" href="#mahasiswabimbingan" role="tab" aria-controls="home" aria-selected="true">Mahasiswa bimbingan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mahasiswa-uji-tab" data-toggle="tab" href="#mahasiswauji" role="tab" aria-controls="profile" aria-selected="false">Mahasiswa Uji</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="mahasiswabimbingan" role="tabpanel" aria-labelledby="mahasiswa-bimbingan-tab">
                <h3>Daftar Mahasiswa Bimbingan</h3>
                <div class="row justify-content-center">
                <table class="mahasiswa-control-table">
                    <tr class="text-center">
                        <th>
                            No
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            NIM
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                @foreach($mahasiswabimbingan as $item)
                    @php($user = $item->user())
                    <tr class="text-center">
                    <td>
                        {{$loop->iteration}}
                    </td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->username}}
                        </td>
                        <td>
                            {{$item->getStatusString()}}
                        </td>
                    </tr>
                @endforeach
                </table>
                </div>
            </div>
            <div class="tab-pane fade" id="mahasiswauji" role="tabpanel" aria-labelledby="mahasiswa-uji-tab">
            <h3>Daftar Mahasiswa Uji</h3>
                <div class="row justify-content-center">
                <table class="mahasiswa-control-table">
                    <tr class="text-center">
                        <th>
                            No
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            NIM
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                {{--@foreach($mahasiswauji as $item)--}}
                    {{--@php($user = $item->user())--}}
                    {{--<tr class="text-center">--}}
                    {{--<td>--}}
                        {{--{{$loop->iteration}}--}}
                    {{--</td>--}}
                        {{--<td>--}}
                            {{--{{$user->name}}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{$user->username}}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{$item->getStatusString()}}--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection