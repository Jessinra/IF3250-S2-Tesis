@extends('layouts.app')
@section('title','Pendaftaran Sidang Tesis')

@section('content')
    <div class="container">
        <h2  class="text-center">Formulir Pendaftaran Sidang Tesis</h2>
        <br>
        <div id="form-app">
            <form action="" method="post" id="form-daftar-sidang" >
{{--                {{csrf_field()}}--}}
                {{--<input type="hidden" id="id" name="id"  value="{{$id}}">--}}
                <div class="form-group">
                    <div class="form-group row col-md-12">
                        <label for="semester-daftar" class="col-md-4 col-form-label text-md-right text-center">Terdaftar pada Semester<sup>*</sup></label>
                        <input type="text" id="semester_daftar" name="semester_daftar" class="form-control col-md-8 " value="" required>
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="tanggal_seminar_tesis" class="col-md-4 col-form-label text-md-right text-center">Waktu Seminar Tesis<sup>*</sup></label>
                        <input type="datetime-local" id="tanggal_seminar_tesis" name="tanggal_seminar_tesis" class="form-control col-md-8 " value="" required>
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
