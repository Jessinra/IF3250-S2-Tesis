@extends('layouts.app')
@section('title','Formulir Pengajuan Topik')

@section('content')
    <div class="container">
        <h2  class="text-center">Formulir Pengajuan Topik Tesis</h2>
        <br>
        <div id="form-app">
        <form action="" method="post" id="form-pengajuan" >
            {{csrf_field()}}
            <input type="hidden" v-model="JSON.stringify(topics)" name="topics">
                <div v-for="(n, i) in count">
                    <div class="form-group">
                        <h3 class="row align-items-center">Prioritas @{{i+1}} <sup v-if="i==0">*</sup></h3>
                            <input type="hidden" v-model="topics[i].prioritas = i">
                            <div class="form-group row col-md-12">
                                <label for="judul" class="col-md-4 col-form-label text-md-right text-center">Judul Topik Tesis <sup>*</sup></label>
                                <input type="text" v-model="topics[i].judul" id="judul" class="form-control col-md-8 " required>
                            </div>
                            <div class="form-group row col-md-12">
                                <label for="keilmuan" class="col-md-4 col-form-label text-md-right text-center ">Area Keilmuan<sup>*</sup></label>
                                <input type="text" id="keilmuan" v-model="topics[i].keilmuan" class="form-control col-md-8 " required>
                            </div>
                            <div class="form-group row col-md-12">
                                <label for="cdb1" class="col-md-4 col-form-label text-md-right text-center ">Calon Dosen Pembimbing 1<sup>*</sup></label>
                                <select type="text" id="cdb1" class="form-control col-md-8" v-model="topics[i].calon_pembimbing1" name="calon_pembimbing1" required>
                                    <option value="" disabled>Pilih Dosen</option>
                                    @foreach($list_pembimbing1 as $item)
                                        @php($user_item = $item->user())
                                        <option value="{{$user_item->id}}">{{$user_item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row col-md-12">
                                <label for="cdb2" class="col-md-4 col-form-label text-md-right text-center ">Calon Dosen Pembimbing 2</label>
                                <select type="text" id="cdb2" class="form-control col-md-8" name="calon_pemimbing2"  v-model="topics[i].calon_pembimbing2" >
                                    <option value="" disabled>Pilih Dosen</option>
                                    @foreach($list_pembimbing2 as $item)
                                        @php($user_item = $item->user())
                                        <option value="{{$user_item->id}}">{{$user_item->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>
        </form>
            <span><sup>*</sup>Wajib diisi</span>
            <div class="row  mt-4 mb-4 justify-content-center">
                <button class=" justify-content-center mr-1 align-items-center btn-red btn display-flex cursor-pointer" v-on:click="decrement" v-if="count>1">
                    <i class="material-icons md-24">remove_circle</i>
                    <span class="mb-0 mt-0 ml-0 mr-0">Kurangi Topik</span>
                </button>
                <button class=" justify-content-center ml-1 align-items-center btn-green btn display-flex cursor-pointer" v-on:click="increment" v-if="count<3">
                    <i class="material-icons md-24">add_circle</i>
                    <span class="mb-0 mt-0 ml-0 mr-0">Tambah Topik</span>
                </button>
            </div>
        <div class="row justify-content-center align-items-center">
            <button type="exit" class="btn btn-white mr-2" onclick="backpage()">Cancel</button>
            <button type="submit" form="form-pengajuan" class="btn btn-blue ml-2">Submit</button>
        </div>
        </div>
    </div>

@endsection
@section('bottomjs')
    <script>
        var form_app = new Vue({
            el: '#form-app',
            data: {
                count: {{$topics->count()}},
                topics: {!! json_encode($topics) !!}

            },
            methods: {
                increment: function () {
                    if(this.count < 3) {
                        this.count = this.count + 1;
                        this.topics.push({});
                    }
                },
                decrement: function() {
                    if (this.count > 0) {
                        this.count = this.count - 1;
                        this.topics.pop();
                    }
                }
            }
        })
    </script>
@endsection