@extends('layouts.app')
@section('title', 'Daftar Nilai Akhir Mahasiswa')

@section('content')
    <div class="container">
        <h3>Daftar Nilai Akhir Mahasiswa</h3>

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
                        Nilai
                    </th>
                    <th>
                        Topik
                    </th>
                    <th>
                        Dosen Pembimbing
                    </th>
                    <th>
                        Dosen Penguji
                    </th>
                    <th></th>
                </tr>
                </thead>

                @foreach($sidang_tesis as $item)
                    <tr class="text-center">
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$item->tesis->mahasiswa->user()->username}}
                        </td>
                        <td>
                            {{$item->tesis->mahasiswa->user()->name}}
                        </td>
                        <td>
                            {{$item->tesis->nilai}}
                        </td>
                        <td>
                            {{$item->tesis->topic}}
                        </td>
                        <td>
                            {{$item->tesis->dosen_pembimbing_1->user->name}}
                        </td>
                        <td>
                            {{$item->dosen_penguji}}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection