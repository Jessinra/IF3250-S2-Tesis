@extends('layouts.app')

@section('title','Upload Proposal')

@section('content')
    <div class="container" id="proposal-uploader">
        <h2 class="text-center">Upload Proposal Tesis</h2>
        <form method="post" enctype="multipart/form-data" id="form-uploader" class="mt-4">
            {{csrf_field()}}
            <div class="row justify-content-center form-group">
                <input type="file" id="uploader" name="proposal" class="sr-only"  v-on:change="onFileChange">
                <label for="uploader" class="uploader-label">
                    <i class="material-icons md-24">insert_drive_file</i>
                    Upload Proposal
            </label>
            </div>

        </form>
        <div v-if="file != null" class="mb-4">
            <div class="row">
                <div class="col-6 text-right">File Name :</div>
                <div class="col-6 text-left">@{{ file.name }}</div>
            </div>
            <div class="row">
                <div class="col-6 text-right">File Size :</div>
                <div class="col-6 text-left">@{{ humanFileSize(file.size) }}</div>
            </div>

            <div class="row justify-content-center align-items-center mt-4">
                <button type="exit" class="btn btn-white mr-2" onclick="backpage()">Cancel</button>
                <button type="submit" form="form-uploader" class="btn btn-green ml-2">Submit</button>
            </div>
        </div>
    </div>
@endsection

@section('bottomjs')
    <script>
        var app = new Vue({
            el: "#proposal-uploader",
            data: {
                file: null
            },
            methods: {
                onFileChange: function() {
                        this.file = $("#uploader")[0].files[0];
                        console.log(this.file);
                },
                humanFileSize: function (size) {
                    var i = Math.floor( Math.log(size) / Math.log(1024) );
                    return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
                }
            }
        });


    </script>
@endsection