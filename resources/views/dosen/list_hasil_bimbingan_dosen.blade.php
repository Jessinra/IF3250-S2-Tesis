@extends('layouts.app')
@section('title', 'Hasil Bimbingan')

@section('content')
    <div class="container">
        <h3>Hasil Bimbingan</h3>
        <form action="{{route('bimbingan-persetujuan')}}" method="post">

        <div class="row justify-content-center">

            <div class="add">
                <button type="submit" class="btn btn-blue disabled" id="save" disabled>Simpan</button>
            </div>

        </div>
        <div class="row justify-content-center table-x">
            <table class="mahasiswa-control-table table table-hover">
                <tr class="text-center">
                    <th>
                        No
                    </th>

                    <th>
                        NIM
                    </th>

                    <th>
                        Nama
                    </th>

                    <th>
                        Topik
                    </th>
                    <th>
                        Waktu Bimbingan
                    </th>
                    <th>
                        Status
                    </th>
                    <th class="row justify-content-center">
                        <div class="setujui row justify-content-center">
                        Setujui
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="selectall" onclick="checkAll(); updateSaveButton();">
                            <label class="custom-control-label" for="selectall"> </label>
                        </div>
                        </div>
                    </th>
                    <th></th>
                </tr>
                @foreach($hsl_bimbingan as $item)
                    <tr class="text-center">
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$item->thesis->mahasiswa->user()->username}}
                        </td>
                        <td>
                            {{$item->thesis->mahasiswa->user()->name}}
                        </td>
                        <td>
                            {{$item->topik}}
                        </td>
                        <td>
                            {{$item->tanggal_waktu}}
                        </td>
                        <td>
                            {{$item->getStatusString()}}
                        </td>

                        <td class="row justify-content-center ">
                            @if($item->status == 0)
                                <div class="custom-control custom-checkbox">
                                    {{csrf_field()}}
                                    <input class="custom-control-input" type="checkbox" id="{{$item->id}}" name="{{$item->id}}" value="{{$item->id}}" onclick="updateSaveButton()">
                                    <label class="custom-control-label" for="{{$item->id}}"> </label>
                                </div>
                            @endif
                        </td>
                        <td >

                            <button type="button" class="btn btn-icon display-flex justify-content-center align-items-center" data-toggle="modal" data-target="#hsl{{$loop->iteration}}">
                                <i class="material-icons font-size-18-px">
                                    search
                                </i>
                            </button>

                            <!-- The Modal -->
                            <div class="modal fade" id="hsl{{$loop->iteration}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{$item->thesis->mahasiswa->user()->name}} - {{$item->thesis->mahasiswa->user()->username}}</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <h5>Topik: </h5>
                                            <p>{{$item->topik}}</p>
                                            <h5>Waktu Bimbingan: </h5>
                                            <p>{{$item->tanggal_waktu}}</p>
                                            <h5>Hasil dan diskusi: </h5>
                                            <p>{{$item->hasil_dan_diskusi}}</p>
                                            <h5>Rencana tindak lanjut:</h5>
                                            <p>{{$item->rencana_tindak_lanjut}}</p>
                                            <h5>Waktu Bimbingan Selanjutnya: </h5>
                                            <p>{{$item->waktu_bimbingan_selanjutnya}}</p>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        </form>
    </div>
@endsection

@section('bottomjs')
    <script>
    function updateSaveButton(){
        var chkbox = document.querySelectorAll(".custom-control-input");
        var saveButton = document.getElementById("save");
        var selectAll = document.getElementById("selectall");
        var counter = 0;
        var start = 0;

        if(selectAll.checked){
            start = 1;
        }

        for(var i = start; i < chkbox.length; i++){
            if(chkbox[i].checked){
                counter++;
            }
        }

        if(counter < chkbox.length-1){
            selectAll.checked = false;
        }else{
            selectAll.checked = true;
        }

        if(counter > 0){
            saveButton.classList.remove("disabled");
            saveButton.disabled = false;
        }else{
            saveButton.classList.add("disabled");
            saveButton.disabled = true;
        }

    }

    function checkAll(){
        var chkbox = document.querySelectorAll(".custom-control-input");
        if(chkbox[0].checked) {
            for (var i = 1; i < chkbox.length; i++) {
                chkbox[i].checked = true;
            }
        }else{
            for (var i = 1; i < chkbox.length; i++) {
                chkbox[i].checked = false;
            }
        }
    }
    </script>
@endsection