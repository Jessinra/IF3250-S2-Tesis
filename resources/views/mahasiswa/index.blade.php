@extends('layouts.app')
@section('title')Dashboard Mahasiswa @endsection
@php
    $user = Auth::user();
@endphp
@section('content')
    <div class="container dashboard-mahasiswa">
        <div class="user-section row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-color-white">{{$user->name}}</h2>
                <h3 class="text-center text-color-white">{{$user->username}}</h3>
            </div>
        </div>
    </div>
@endsection
