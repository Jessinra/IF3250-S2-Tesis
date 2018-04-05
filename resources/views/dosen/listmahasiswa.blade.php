@extends('layouts.app')
@section('title', 'Dosen')


@section('content')
    <div class="container">
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
@endsection