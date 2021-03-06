@extends('layouts.app')
@section('title', 'Daftar Nilai Akhir Mahasiswa')

@section('content')
    <div class="container">
        <h3>Penjadwalan Seminar dan Sidang</h3>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#seminar-topik">Seminar Topik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#seminar-proposal">Seminar Proposal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#seminar-tesis">Seminar Tesis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#sidang-tesis">Sidang Tesis</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="seminar-topik" class="container tab-pane active">
                <form action="/penjadwalan/seminartopik" method="post">
                    {{csrf_field()}}
                    <div class="row justify-content-center">
                        <div class="add">
                            <button type="submit" class="btn btn-blue disabled" id="save" disabled>Simpan</button>
                        </div>
                    </div>
                    <div class="row justify-content-center table-x">
                        <table class="mahasiswa-control-table table table-hover">
                            <thead>
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
                                    Waktu
                                </th>
                                <th></th>
                            </tr>
                            </thead>

                            @php($count = 0)
                            @foreach($topik as $item)
                                <tr class="text-center">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$item->topic->mahasiswa->user()->username}}
                                    </td>
                                    <td>
                                        {{$item->topic->mahasiswa->user()->name}}
                                    </td>
                                    <td>
                                        {{$item->topic->judul}}
                                    </td>
                                    <td>
                                        <input type="hidden" id="id{{$item->topic->mahasiswa_id}}" name="id{{$item->topic->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->topic->mahasiswa_id}}">
                                        <input type="hidden" id="tp{{$item->topic->mahasiswa_id}}" name="tp{{$item->topic->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->topic_id}}">
                                        <input type="text" data-field="datetime" id="sch{{$item->topic->mahasiswa_id}}" name="sch{{$item->topic->mahasiswa_id}}" class="datetime form-control col-lg-12 " value="">
                                    </td>
                                </tr>
                                @php($count++)
                            @endforeach
                            @php($prev = -1)
                            @php($no = 1)
                            @foreach($seminar_topik as $item)
                                @php($tgl = $item->schedule)
                                @php($tgl = substr(str_replace(" ","T",$tgl),0,16))
                                @if($prev != $item->topik_id)
                                    @if($item->topik->topic->mahasiswa->status == \App\Mahasiswa::STATUS_TOPIK_DITERIMA)
                                        <tr class="text-center">
                                            <td>
                                                {{$no + $count}}
                                            </td>
                                            <td>
                                                {{$item->topik->topic->mahasiswa->user()->username}}
                                            </td>
                                            <td>
                                                {{$item->topik->topic->mahasiswa->user()->name}}
                                            </td>
                                            <td>
                                                {{$item->topik->topic->judul}}
                                            </td>
                                            <td>
                                                <input type="hidden" id="id{{$item->mahasiswa_id}}" name="id{{$item->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->mahasiswa_id}}">
                                                <input type="hidden" id="tp{{$item->mahasiswa_id}}" name="tp{{$item->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->topik_id}}">
                                                <input type="text" data-filed="datetime" id="sch{{$item->mahasiswa_id}}" name="sch{{$item->mahasiswa_id}}" class="datetime form-control col-lg-12 " value="{{$tgl}}" onkeyup="updateSaveButton()">
                                            </td>
                                        </tr>
                                        @php($no++)
                                    @endif
                                @endif
                                @php($prev = $item->topik_id)
                            @endforeach
                            @php($prev = -1)
                            @foreach($seminar_topik as $item)
                                @if($prev != $item->topik_id)
                                    @if($item->topik->topic->mahasiswa->status > \App\Mahasiswa::STATUS_TOPIK_DITERIMA)
                                        <tr class="text-center">
                                            <td>
                                                {{$loop->iteration + $count + $no - 1}}
                                            </td>
                                            <td>
                                                {{$item->topik->topic->mahasiswa->user()->username}}
                                            </td>
                                            <td>
                                                {{$item->topik->topic->mahasiswa->user()->name}}
                                            </td>
                                            <td>
                                                {{$item->topik->topic->judul}}
                                            </td>
                                            <td>
                                                {{$item->schedule}}
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                                @php($prev = $item->topik_id)
                            @endforeach
                        </table>
                    </div>
                </form>
            </div>

            <div id="seminar-proposal" class="container tab-pane">
                <form action="/penjadwalan/seminarproposal" method="post">
                    {{csrf_field()}}
                    <div class="row justify-content-center">
                        <div class="add">
                            <button type="submit" class="btn btn-blue disabled" id="save2" disabled>Simpan</button>
                        </div>
                    </div>
                    <div class="row justify-content-center table-x">
                        <table class="mahasiswa-control-table table table-hover">
                            <thead>
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
                                    Waktu
                                </th>
                                <th></th>
                            </tr>
                            </thead>
                            @php($count = 0)
                            @foreach($proposal as $item)
                                <tr class="text-center">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$item->mahasiswa->user()->username}}
                                    </td>
                                    <td>
                                        {{$item->mahasiswa->user()->name}}
                                    </td>
                                    <td>
                                        <input type="hidden" id="id{{$item->mahasiswa_id}}" name="id{{$item->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->mahasiswa_id}}">
                                        <input type="hidden" id="tp{{$item->mahasiswa_id}}" name="tp{{$item->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->id}}">
                                        <input type="text" data-field="datetime" id="sch{{$item->mahasiswa_id}}" name="sch{{$item->mahasiswa_id}}" class="datetime2 form-control col-lg-12 " value="" onkeyup="updateSaveButton2()">
                                    </td>
                                </tr>
                                @php($count++)
                            @endforeach
                            @php($prev = -1)
                            @php($no = 1)
                            @foreach($seminar_proposal as $item)
                                @php($tgl = $item->schedule)
                                @php($tgl = substr(str_replace(" ","T",$tgl),0,16))
                                @if($prev != $item->proposal_id)
                                    @if($item->mahasiswa->status == \App\Mahasiswa::STATUS_PROPOSAL_DITERIMA)
                                        <tr class="text-center">
                                            <td>
                                                {{$no + $count}}
                                            </td>
                                            <td>
                                                {{$item->mahasiswa->user()->username}}
                                            </td>
                                            <td>
                                                {{$item->mahasiswa->user()->name}}
                                            </td>
                                            <td>
                                                <input type="hidden" id="id{{$item->mahasiswa_id}}" name="id{{$item->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->mahasiswa_id}}">
                                                <input type="hidden" id="tp{{$item->mahasiswa_id}}" name="tp{{$item->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->proposal_id}}">
                                                <input type="hidden" id="pa{{$item->mahasiswa_id}}" name="pa{{$item->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->id_dosen_pembimbing_1}}">
                                                <input type="hidden" id="pb{{$item->mahasiswa_id}}" name="pb{{$item->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->id_dosen_pembimbing_2}}">
                                                <input type="hidden" id="pg{{$item->mahasiswa_id}}" name="pg{{$item->mahasiswa_id}}" class="form-control col-md-8 " value="{{$item->id_dosen_penguji}}">
                                                <input type="text" data-field="datetime" id="sch{{$item->mahasiswa_id}}" name="sch{{$item->mahasiswa_id}}" class="datetime2 form-control col-lg-12 " value="{{$tgl}}" onkeyup="updateSaveButton2()">
                                            </td>
                                        </tr>
                                        @php($no++)
                                    @endif
                                @endif
                                @php($prev = $item->proposal_id)
                            @endforeach

                            @php($prev = -1)
                            @foreach($seminar_proposal as $item)
                                @if($prev != $item->proposal_id)
                                    @if($item->mahasiswa->status > \App\Mahasiswa::STATUS_PROPOSAL_DITERIMA)
                                        <tr class="text-center">
                                            <td>
                                                {{$loop->iteration + $count + $no - 1}}
                                            </td>
                                            <td>
                                                {{$item->mahasiswa->user()->username}}
                                            </td>
                                            <td>
                                                {{$item->mahasiswa->user()->name}}
                                            </td>
                                            <td>
                                                {{$item->schedule}}
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                                @php($prev = $item->proposal_id)
                            @endforeach
                        </table>
                    </div>
                </form>
            </div>

            <div id="seminar-tesis" class="container tab-pane">
                <form action="/penjadwalan/seminarproposal" method="post">
                    {{csrf_field()}}
                    <div class="row justify-content-center">
                    </div>
                    <div class="row justify-content-center table-x">
                        <table class="mahasiswa-control-table table table-hover">
                            <thead>
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
                                    Waktu
                                </th>
                                <th>
                                    Tempat
                                </th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($seminar_tesis as $item)
                                <tr class="text-center">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$item->tesis->mahasiswa->user()->username}}
                                    </td>
                                    <td>
                                        {{$item->tesis->mahasiswa->user()->name}}
                                    </td>
                                    <td>
                                        {{$item->hari}} {{$item->waktu}}
                                    </td>
                                    <td>
                                        {{$item->tempat}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </form>
            </div>

            <div id="sidang-tesis" class="container tab-pane">
                <form action="/penjadwalan/seminarproposal" method="post">
                    {{csrf_field()}}
                    <div class="row justify-content-center">
                    </div>
                    <div class="row justify-content-center table-x">
                        <table class="mahasiswa-control-table table table-hover">
                            <thead>
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
                                    Waktu
                                </th>
                                <th>
                                    Tempat
                                </th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($sidang_tesis as $item)
                                <tr class="text-center">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$item->tesis->mahasiswa->user()->username}}
                                    </td>
                                    <td>
                                        {{$item->tesis->mahasiswa->user()->name}}
                                    </td>
                                    <td>
                                        {{$item->tanggal}} {{$item->jam}}
                                    </td>
                                    <td>
                                        {{$item->tempat}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <div id="dtbox"></div>
    </div>
@endsection

@section('bottomjs')
    <script>
        $(".datetime").change(function(){
            updateSaveButton();
        });

        $(".datetime2").change(function(){
            updateSaveButton2();
        });
        function updateSaveButton2() {
            var inputs = document.getElementsByClassName('datetime');
            var button = document.getElementById('save2');
            for(var i = 0; i < inputs.length; i++){
                if(inputs[i].value.toString() === ""){
                    button.classList.add('disabled');
                    button.disabled = true;
                }else{
                    //alert(inputs[i].value.toString());
                    // inputs[i].value = getFixedDateTimeString(inputs[i].value);
                    button.classList.remove('disabled');
                    button.disabled = false;
                    break;
                }
            }
        }

        function updateSaveButton() {
            var inputs = document.getElementsByClassName('datetime');
            var button = document.getElementById('save');
            for(var i = 0; i < inputs.length; i++){
                if(inputs[i].value.toString() === ""){
                    button.classList.add('disabled');
                    button.disabled = true;
                }else{
                    //alert(inputs[i].value.toString());
                    // inputs[i].value = getFixedDateTimeString(inputs[i].value);
                    button.classList.remove('disabled');
                    button.disabled = false;
                    break;
                }
            }
        }
    </script>
@endsection