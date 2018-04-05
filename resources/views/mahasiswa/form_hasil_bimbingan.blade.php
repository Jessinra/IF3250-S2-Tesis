@extends('layouts.app')
@section('title','Hasil Bimbingan')

@section('content')
    <div class="container">
        <h2  class="text-center">Formulir Hasil Bimbingan</h2>
        <br>
        <div id="form-app">
            <form action="" method="post" id="form-hsl-bimbingan" >
                {{csrf_field()}}
                <div class="form-group">
                    <div class="form-group row col-md-12">
                        <label for="topik" class="col-md-4 col-form-label text-md-right text-center">Topik Bimbingan<sup>*</sup></label>
                        <input type="text" id="topik" name="topik" class="form-control col-md-8 " required>
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="dosen_id" class="col-md-4 col-form-label text-md-right text-center ">Dosen Pembimbing<sup>*</sup></label>
                        <select type="text" id="dosen_id" class="form-control col-md-8" name="dosen_id">
                            <option value="" disabled>Pilih Dosen</option>
                            <option value=""></option>
                            @foreach($dosen as $item)
                                @php($user_item = $item->user())
                                <option value="{{$user_item->id}}">{{$user_item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="tanggal_waktu" class="col-md-4 col-form-label text-md-right text-center">Waktu Bimbingan<sup>*</sup></label>
                        <input type="datetime-local" id="tanggal_waktu" name="tanggal_waktu" class="form-control col-md-8 " required>
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="hasil_dan_diskusi" class="col-md-4 col-form-label text-md-right text-center ">Hasil dan Diskusi<sup>*</sup></label>
                        <input type="text" id="hasil_dan_diskusi" name="hasil_dan_diskusi" class="form-control col-md-8 " required>
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="rencana_tindak_lanjut" class="col-md-4 col-form-label text-md-right text-center ">Rencana Tindak Lanjut<sup>*</sup></label>
                        <input type="text" id="rencana_tindak_lanjut" name="rencana_tindak_lanjut" class="form-control col-md-8 " required>
                    </div>
                </div>

            </form>
            <span><sup>*</sup>Wajib diisi</span>
            <div class="row justify-content-center align-items-center">
                <button type="exit" class="btn btn-white mr-2" onclick="backpage()">Cancel</button>
                <button type="submit" form="form-hsl-bimbingan" class="btn btn-blue ml-2">Submit</button>
            </div>
        </div>
    </div>
@endsection