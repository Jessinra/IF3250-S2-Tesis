@extends('layouts.app')
@section('title', 'Hasil Bimbingan')

@section('content')
    <div class="container">
        <h3>Hasil Bimbingan</h3>
        <div class="row justify-content-center">
            <table class="mahasiswa-control-table">
                <tr class="text-center">
                    <th>
                        No
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
                </tr>
                @foreach($hsl_bimbingan as $item)
                    <tr class="text-center">
                        <td>
                            {{$loop->iteration}}
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

                            <button class="btn btn-primary display-flex justify-content-center align-items-center" data-toggle="modal" data-target="#hsl{{$loop->iteration}}">
                                <i class="material-icons font-size-18-px">
                                    edit
                                </i>
                                <span class="ml-1">Edit</span>
                            </button>

                            <!-- The Modal -->
                            <div class="modal fade" id="hsl{{$loop->iteration}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{$item->name}} - {{$item->username}}</h4>
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

                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <form action="{{route('bimbingan-persetujuan')}}" method="post">
                                                {{csrf_field()}}
                                                <input type="hidden" value="{{$item->id}}" name="id">
                                                <button type="submit" class="btn btn-danger" name=action value="-1">Tolak</button>
                                                <button type="submit" class="btn btn-blue" name=action value="1">Setujui</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection