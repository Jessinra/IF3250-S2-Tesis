@extends('layouts.app')
@section('title','Hasil Bimbingan')

@php
    if(count($hsl_bimbingan) > 0){
        $id = $hsl_bimbingan[0]->id;
        $tgl = $hsl_bimbingan[0]->tanggal_waktu;
        $tgl = substr(str_replace(" ","T",$tgl),0,16);
        $topik = $hsl_bimbingan[0]->topik;
        $diskusi = $hsl_bimbingan[0]->hasil_dan_diskusi;
        $rencana = $hsl_bimbingan[0]->rencana_tindak_lanjut;
    }else{
        $id = 0;
        $tgl = "";
        $topik = "";
        $diskusi = "";
        $rencana = "";
    }
@endphp

@section('content')
    <div class="container">
        <h2  class="text-center">Formulir Hasil Bimbingan</h2>
        <br>
        <div id="form-app">
            <form action="" method="post" id="form-hsl-bimbingan" >
                {{csrf_field()}}
                <input type="hidden" id="id" name="id"  value="{{$id}}">
                <div class="form-group">
                    <div class="form-group row col-md-12">
                        <label for="topik" class="col-md-4 col-form-label text-md-right text-center">Topik Bimbingan<sup>*</sup></label>
                        <input type="text" id="topik" name="topik" class="form-control col-md-8 " value="{{$topik}}" required>
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="dosen_id" class="col-md-4 col-form-label text-md-right text-center ">Dosen Pembimbing<sup>*</sup></label>
                        <select type="text" id="dosen_id" class="form-control col-md-8" name="dosen_id">
                            <option value="" disabled>Pilih Dosen</option>
                            <option value=""></option>
                            @foreach($dosen1 as $item)
                                @php($user_item = $item->user)
                                @if(count($hsl_bimbingan) > 0)
                                    @if($hsl_bimbingan[0]->dosen_id == $user_item->id)
                                        <option value="{{$user_item->id}}" selected="selected">{{$user_item->name}}</option>
                                    @else
                                        <option value="{{$user_item->id}}">{{$user_item->name}}</option>
                                    @endif
                                @else
                                    <option value="{{$user_item->id}}">{{$user_item->name}}</option>
                                @endif
                            @endforeach
                            @foreach($dosen2 as $item)
                                @php($user_item = $item->user)
                                @if(count($hsl_bimbingan) > 0)
                                    @if($hsl_bimbingan[0]->dosen_id == $user_item->id)
                                        <option value="{{$user_item->id}}" selected="selected">{{$user_item->name}}</option>
                                    @else
                                        <option value="{{$user_item->id}}">{{$user_item->name}}</option>
                                    @endif
                                @else
                                    <option value="{{$user_item->id}}">{{$user_item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="tanggal_waktu" class="col-md-4 col-form-label text-md-right text-center">Waktu Bimbingan<sup>*</sup></label>
                        <input type="datetime-local" id="tanggal_waktu" name="tanggal_waktu" class="form-control col-md-8 " value="{{$tgl}}" required>
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="hasil_dan_diskusi" class="col-md-4 col-form-label text-md-right text-center ">Hasil dan Diskusi<sup>*</sup></label>
                        <textarea class="form-control col-md-8" name="hasil_dan_diskusi" form="form-hsl-bimbingan" required>{{$diskusi}}</textarea>
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="rencana_tindak_lanjut" class="col-md-4 col-form-label text-md-right text-center ">Rencana Tindak Lanjut<sup>*</sup></label>
                        <textarea class="form-control col-md-8" name="rencana_tindak_lanjut" form="form-hsl-bimbingan" required>{{$rencana}}</textarea>
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