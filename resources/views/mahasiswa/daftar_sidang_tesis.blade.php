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
                        <!--label for="eval_diri" class="col-md-4 col-form-label text-md-right text-center ">Print Out Evaluasi Diri<sup>*</sup></label-->
                        <input type="file" id="eval_diri" name="eval_diri" class="sr-only">
                        <label for="eval_diri" class="">
                            <i class="material-icons md-24">insert_drive_file</i>
                            Upload Evaluasi Diri
                        </label>
                    </div>
                    <div class="form-group row col-md-12">
                        <input type="file" id="draft_makalah" name="draft_makalah" class="sr-only">
                        <label for="eval_diri" class="">
                            <i class="material-icons md-24">insert_drive_file</i>
                            Upload Draft Makalah
                        </label>
                    </div>
                    <div class="form-group row col-md-12">
                        <input type="file" id="laporan_tesis" name="laporan_tesis" class="sr-only">
                        <label for="laporan_tesis" class="">
                            <i class="material-icons md-24">insert_drive_file</i>
                            Upload Laporan Tesis
                        </label>
                    </div>
                    <div class="form-group row col-md-12">
                        <input type="file" id="ksm_akhir" name="ksm_akhir" class="sr-only">
                        <label for="ksm_akhir" class="">
                            <i class="material-icons md-24">insert_drive_file</i>
                            Upload KSM Semester Terakhir
                        </label>
                    </div>
                    <div class="form-group row col-md-12">
                        <input type="file" id="form_paper" name="form_paper" class="sr-only">
                        <label for="form_paper" class="">
                            <i class="material-icons md-24">insert_drive_file</i>
                            Upload Form Submit Paper
                        </label>
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