@extends('layouts.app')
@section('title', 'Dosen')


@section('content')
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
            </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
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