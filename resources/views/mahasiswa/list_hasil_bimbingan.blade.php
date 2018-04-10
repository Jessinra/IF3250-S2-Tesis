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

                        <td>
                            <button class="btn btn-primary display-flex justify-content-center align-items-center" data-toggle="modal" data-target="#hsl{{$loop->iteration}}">
                                <span class="ml-1">Lihat</span>
                            </button>

                            <div class="modal fade" id="hsl{{$loop->iteration}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Topik: {{$item->topik}}</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <h5>Dosen Pembimbing: </h5>
                                            <p>{{$item->name}}</p>
                                            <h5>Waktu Bimbingan: </h5>
                                            <p>{{$item->tanggal_waktu}}</p>
                                            <h5>Hasil dan diskusi: </h5>
                                            <p>{{$item->hasil_dan_diskusi}}</p>
                                            <h5>Rencana tindak lanjut:</h5>
                                            <p>{{$item->rencana_tindak_lanjut}}</p>

                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </td>
                        @if($item->status <= 0)
                            <td class="row justify-content-center ">
                                <form action="" method="post" id="form-id-bimbingan{{$item->id}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                </form>

                                <button type="submit" form="form-id-bimbingan{{$item->id}}" class="btn btn-primary display-flex justify-content-center align-items-center">
                                    <i class="material-icons font-size-18-px">
                                        edit
                                    </i>
                                    <span class="ml-1">Edit</span>
                                </button>

                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection