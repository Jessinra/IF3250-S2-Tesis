@extends('layouts.app')
@section('title','Pendaftaran Sidang Tesis')
@php($user = Auth::user());
@php($sidangTesis = $user->isMahasiswa()->tesis()->sidangTesis())
@php($seminarTesis = $user->isMahasiswa()->tesis()->seminarTesis())
@section('content')
    <div class="container">
        @if(isset($success))
            <div class="alert alert-success display-flex align-items-center">
                <i class="material-icons font-size-18-px">check_circle</i>
                Data Berhasil Disimpan
            </div>
        @endif
        <h2  class="text-center">Formulir Pendaftaran Sidang Tesis</h2>
        <br>
        <div id="form-app">

            <form action="/sidangtesis/mahasiswa/edit/{{$user->username}}" method="post" id="form-daftar-sidang" enctype="multipart/form-data">
                {{csrf_field()}}
                {{--<input type="hidden" id="id" name="id"  value="{{$id}}">--}}
                <div class="form-group">
                    <div class="form-group row col-md-12">
                        <label for="semester-daftar" class="col-md-4 col-form-label text-md-right text-center">Terdaftar pada Semester<sup>*</sup></label>
                        <input type="text" id="semester_daftar" name="semester_daftar" class="form-control col-md-8 " value="{{$sidangTesis->semester_terdaftar}}" required>
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="tanggal_seminar_tesis" class="col-md-4 col-form-label text-md-right text-center">Waktu Seminar Tesis</label>
                        <input type="datetime-local" id="tanggal_seminar_tesis" name="tanggal_seminar_tesis" class="form-control col-md-8 "
                               value="{{date("Y-m-d H:i:s", strtotime("$seminarTesis->hari $seminarTesis->waktu"))}}"
                               required disabled>
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="" class="col-md-4 col-form-label text-md-right text-center">Dokumen Evaluasi Diri</label>
                        <!--label for="eval_diri" class="col-md-4 col-form-label text-md-right text-center ">Print Out Evaluasi Diri<sup>*</sup></label-->
                        <input type="file" id="eval_diri" name="eval_diri" class="sr-only" v-on:change="onFileChange('eval_diri')">
                        <label for="eval_diri" id="label_eval_diri" class="display-flex align-items-center  justify-content-center justify-content-md-start col-12 col-md-3">
                            <i class="material-icons md-24">insert_drive_file</i>
                            Upload Evaluasi Diri
                        </label>
                        <div v-if="eval_diri" class=" col-12 col-md-5 text-center text-md-left">
                        @{{eval_diri.name+" ("+humanFileSize(eval_diri.size)+")"}}
                        </div>
                        @if($sidangTesis->evaluasi_diri)
                            <a href="/sidangtesis/download/{{$sidangTesis->evaluasi_diri}}" class="text-color-blue">
                                {{basename($sidangTesis->evaluasi_diri)}}
                            </a>
                        @endif
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="" class="col-md-4 col-form-label text-md-right text-center">Draft Makalah</label>
                        <input type="file" id="draft_makalah" name="draft_makalah" class="sr-only" v-on:change="onFileChange('draft_makalah')">
                        <label for="draft_makalah" id="label_draft_makalah" class="display-flex align-items-center  justify-content-center justify-content-md-start col-12 col-md-3">
                            <i class="material-icons md-24">insert_drive_file</i>
                            Upload Draft Makalah
                        </label>
                        <div v-if="draft_makalah" class=" col-12 col-md-5 text-center text-md-left">
                            @{{draft_makalah.name+" ("+humanFileSize(draft_makalah.size)+")"}}
                        </div>
                        @if($sidangTesis->draft_makalah)
                            <a href="/sidangtesis/download/{{$sidangTesis->draft_makalah}}" class="text-color-blue">
                                {{basename($sidangTesis->draft_makalah)}}
                            </a>
                        @endif
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="" class="col-md-4 col-form-label text-md-right text-center">Laporan Tesis</label>
                        <input type="file" id="laporan_tesis" name="laporan_tesis" class="sr-only" v-on:change="onFileChange('laporan_tesis')">
                        <label for="laporan_tesis" id="label_laporan_tesis" class="display-flex align-items-center  justify-content-center justify-content-md-start col-12 col-md-3">
                            <i class="material-icons md-24">insert_drive_file</i>
                            Upload Laporan Tesis
                        </label>
                        <div v-if="laporan_tesis" class=" col-12 col-md-5 text-center text-md-left">
                            @{{laporan_tesis.name+" ("+humanFileSize(laporan_tesis.size)+")"}}
                        </div>
                        @if($sidangTesis->laporan_tesis)
                            <a href="/sidangtesis/download/{{$sidangTesis->evaluasi_diri}}" class="text-color-blue">
                                {{basename($sidangTesis->laporan_tesis)}}
                            </a>
                        @endif

                    </div>
                    <div class="form-group row col-md-12">
                        <label for="" class="col-md-4 col-form-label text-md-right text-center">KSM Semester Terakhir</label>
                        <input type="file" id="ksm_akhir" name="ksm_akhir" class="sr-only" v-on:change="onFileChange('ksm_akhir')">
                        <label for="ksm_akhir" id="label_ksm_akhir" class="display-flex align-items-center  justify-content-center justify-content-md-start col-12 col-md-3">
                            <i class="material-icons md-24">insert_drive_file</i>
                            Upload KSM Semester Terakhir
                        </label>

                        <div v-if="ksm_akhir" class=" col-12 col-md-5 text-center text-md-left">
                            @{{ksm_akhir.name+" ("+humanFileSize(ksm_akhir.size)+")"}}
                        </div>

                        @if($sidangTesis->ksm_terakhir)
                            <a href="/sidangtesis/download/{{$sidangTesis->ksm_terakhir}}" class="text-color-blue">
                                {{basename($sidangTesis->ksm_terakhir)}}
                            </a>
                        @endif
                      
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="" class="col-md-4 col-form-label text-md-right text-center">Form Submit Paper</label>
                        <input type="file" id="form_paper" name="form_paper" class="sr-only" v-on:change="onFileChange('form_paper')">
                        <label for="form_paper" id="label_form_paper" class="display-flex align-items-center  justify-content-center justify-content-md-start col-12 col-md-3">
                            <i class="material-icons md-24">insert_drive_file</i>
                            Upload Form Submit Paper
                        </label>
                        <div v-if="form_paper" class=" col-12 col-md-5 text-center text-md-left">
                            @{{form_paper.name+" ("+humanFileSize(form_paper.size)+")"}}
                        </div>
                        @if($sidangTesis->submit_paper)
                            <a href="/sidangtesis/download/{{$sidangTesis->submit_paper}}" class="text-color-blue">
                                {{basename($sidangTesis->submit_paper)}}
                            </a>
                        @endif
                    </div>

                </div>

            </form>
            <span><sup>*</sup>Wajib diisi</span>
            <div class="row justify-content-center align-items-center">
                <button type="exit" class="btn btn-white mr-2" onclick="backpage()">Cancel</button>
                <button type="submit" form="form-daftar-sidang" class="btn btn-blue ml-2">Submit</button>
            </div>
        </div>
    </div>
@endsection


@section('bottomjs')
    <script>
        var app = new Vue({
            el: "#form-app",
            data: {
                eval_diri: null,
                draft_makalah: null,
                laporan_tesis: null,
                ksm_akhir: null,
                form_paper: null
            },
            methods: {
                onFileChange: function(uploader) {
                    this[uploader] = $("#"+uploader)[0].files[0];
                    $("#label_"+uploader).addClass('text-color-green');

                },
                humanFileSize: function (size) {
                    var i = Math.floor( Math.log(size) / Math.log(1024) );
                    return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
                }
            }
        });


    </script>
@endsection
