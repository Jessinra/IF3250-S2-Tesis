@extends('layouts.app')
@section('title','Hasil Bimbingan')

@php
    if(count($hsl_bimbingan) > 0){
        $id = $hsl_bimbingan[0]->id;
        $tgl = $hsl_bimbingan[0]->tanggal_waktu;
        $tgl = substr(str_replace(" ","T",$tgl),0,16);
        $tgl_selanjutnya = $hsl_bimbingan[0]->waktu_bimbingan_selanjutnya;
        $tgl_selanjutnya = substr(str_replace(" ","T",$tgl),0,16);
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
    @php($tesis = Auth::user()->isMahasiswa()->tesis())
    <div class="container">
        <h2  class="text-center">Formulir Jadwal Bimbingan</h2>
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
                        <label for="dosen_id" class="col-md-4 col-form-label text-md-right text-center ">Dosen Pembimbing 1<sup>*</sup></label>
                        <select type="text" id="dosen_id" class="form-control col-md-8" name="dosen_id">
                            <option value="{{$tesis->dosen_pembimbing1}}">
                                {{$tesis->dosen_pembimbing_1->user->name}}
                            </option>
                            @if($tesis->dosen_pembimbing2)
                                <option value="{{$tesis->dosen_pembimbing2}}">
                                    {{$tesis->dosen_pembimbing_2->user->name}}
                                </option>
                            @endif
                        </select>
                    </div>
                    @if($tesis->dosen_pembimbing2)
                    <div class="form-group row col-md-12">
                        <label for="dosen_id2" class="col-md-4 col-form-label text-md-right text-center ">Dosen Pembimbing 2</label>
                        <select type="text" id="dosen_id2" class="form-control col-md-8" name="dosen_id2">
                        <option value="0"></option>
                        <option value="{{$tesis->dosen_pembimbing1}}">
                            {{$tesis->dosen_pembimbing_1->user->name}}
                        </option>
                        @if($tesis->dosen_pembimbing2)
                            <option value="{{$tesis->dosen_pembimbing2}}">
                                {{$tesis->dosen_pembimbing_2->user->name}}
                            </option>
                        @endif
                        </select>
                    </div>
                    @endif
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
                    <div class="form-group row col-md-12">
                        <label for="waktu_bimbingan_selanjutnya" class="col-md-4 col-form-label text-md-right text-center">Waktu Bimbingan Selanjutnya<sup>*</sup></label>
                        <input type="datetime-local" id="waktu_bimbingan_selanjutnya" name="waktu_bimbingan_selanjutnya" class="form-control col-md-8 " value="{{$tgl}}" required>
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