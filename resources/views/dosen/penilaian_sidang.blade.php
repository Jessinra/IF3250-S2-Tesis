@extends('layouts.app')
@section('title', 'Dosen')


@section('content')

@php($tesis = $mahasiswa->tesis())
@php($sidangtesis = $tesis->sidangtesis())
<div class="col-md-8">
    @if ($sidangTesis)
    <div class="mb-2">
        <h3>
            Penilaian Sidang Tesis
        </h3>
        @if($mahasiswa->status >= \App\Mahasiswa::STATUS_LULUS)
        <div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
            <i class="material-icons font-size-18-px mr-2">check_circle</i>
                 &nbsp Kelulusan mahasiswa ditetapkan pada {{date("d M Y H:i:s", strtotime($sidangTopik->updated_at.'UTC'))}}

        </div>
        @endif
        <div class="row justify-content-center">
            <form action="/sidangtesis/nilai/{{$user->username}}" method="post" class="width-full">
                {{csrf_field()}}
                <input type="hidden" value="{{$user->username}}" name="mahasiswa">
                <div class="form-group row width-full justify-content-center">
                    <label for="scoreIndexUtama" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Utama</label>
                    <select class="form-control col-sm-2 ml-1 mr-1" name="scoreUtama" id="scoreIndexUtama">
                        <option value="L">L</option>
                        <option value="M">M</option>
                        <option value="K">K</option>
                    </select>
                </div>
                <div class="form-group row width-full justify-content-center">
                    <label for="scoreIndexPenting" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Penting</label>
                        <select class="form-control col-sm-2 ml-1 mr-1" name="scorePenting" id="scoreIndexPenting">
                            <option value="L">L</option>
                            <option value="M">M</option>
                            <option value="K">K</option>
                        </select>
                </div>
                <div class="form-group row width-full justify-content-center">
                    <label for="scoreIndexPendukung" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Pendukung</label>
                        <select class="form-control col-sm-2 ml-1 mr-1" name="scorePendukung" id="scoreIndexPendukung">
                            <option value="L">L</option>
                            <option value="M">M</option>
                            <option value="K">K</option>
                        </select>
                </div>
                <div class="form-group row width-full justify-content-center">
                    <button  class="col-md-2 btn btn-blue ml-1 mr-1">
                        Tetapkan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif