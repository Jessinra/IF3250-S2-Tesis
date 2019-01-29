@extends('layouts.app')
@section('title')Dashboard Dosen @endsection
@php($user = $mahasiswa->user())
@php($seminarTesis = $mahasiswa->tesis()->seminarTesis())
@section('content')
    <div class="container">
        <h2>
            Buat Pengajuan Seminar Tesis
        </h2>
        <div>
            <div id="form-app">
                <form action="" method="post" id="form-hsl-bimbingan" >
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="form-group row col-md-12">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-center ">Nama<sup>*</sup></label>
                            <input type="text" name="name" id="name" class="col-md-8 form-control"  value="{{$user->name}}" required disabled>
                        </div>
                        <div class="form-group row col-md-12">
                            <label for="nim" class="col-md-4 col-form-label text-md-right text-center">NIM<sup>*</sup></label>
                            <input type="text" name="nim" id="nim" class="col-md-8 form-control" value="{{$user->username}}" required disabled>
                        </div>
                        <div class="form-group row col-md-12">
                            <label for="judul" class="col-md-4 col-form-label text-md-right text-center ">Judul Tesis<sup>*</sup></label>
                            <input type="text" id="judul" name="judul" class="col-md-8 form-control" value="{{$mahasiswa->tesis()->judul_thesis}}">
                        </div>



                        <div class="form-group row col-md-12">
                            <label for="haritgl" class="col-md-4 col-form-label text-md-right text-center">
                                Tanggal
                            </label>
                            <input type="date" id="haritgl" name="haritgl" class="col-md-8 form-control" >
                        </div>

                        <div class="form-group row col-md-12">
                            <label for="waktu" class="col-md-4 col-form-label text-md-right text-center">
                                Waktu
                            </label>
                            <input type="time" id="haritgl" name="waktu" class="col-md-8 form-control" >
                        </div>

                        <div class="form-group row col-md-12">
                            <label for="tempat" class="col-md-4 col-form-label text-md-right text-center">
                                Tempat
                            </label>
                            <input type="string" id="tempat" name="tempat" class="col-md-8 form-control" >
                        </div>


                    </div>

                </form>
                <div class="row justify-content-center align-items-center">
                    <button type="exit" class="btn btn-white mr-2" onclick="backpage()">Cancel</button>
                    <button type="submit" form="form-hsl-bimbingan" class="btn btn-blue ml-2">Submit</button>
                </div>
            </div>

        </div>
    </div>
@endsection
