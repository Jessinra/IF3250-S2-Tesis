@extends('layouts.app')
@section('title')Dashboard Dosen @endsection
@php($user = $mahasiswa->user())
@php($seminarTesis = $mahasiswa->tesis()->seminarTesis)
@section('content')
    <div class="container">
        <h3>
            Buat Pengajuan Seminar Tesis
        </h3>
        <div>
            {{$user}}
            {{$sem}}
        </div>
    </div>
@endsection
