@extends('layouts.app')
@section('title', 'List Pengajuan Topik')


@section('content')
    <div class="container">
        <h3>Daftar Mahasiswa Tahap Topik</h3>
        <table>
        @foreach($mahasiswa as $item)

        @endforeach
        </table>

    </div>
@endsection