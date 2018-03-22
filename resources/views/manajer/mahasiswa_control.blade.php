@extends('layouts.app')
@section('title', 'List Pengajuan Topik')


@section('content')
    <div class="container">
        <h3>Daftar Mahasiswa Aktif</h3>
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
                <th>
                    Aksi
                </th>
            </tr>
        @foreach($mahasiswa as $item)
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
                <td class="row justify-content-center ">
                    <a href="/mahasiswa/control/{{$user->username}}">
                    <button class="btn btn-primary display-flex justify-content-center align-items-center">
                        <i class="material-icons font-size-18-px">
                            edit
                        </i>
                        <span class="ml-1">Edit</span>
                    </button>
                    </a>
                </td>
            </tr>
        @endforeach
        </table>
        </div>
    </div>
@endsection