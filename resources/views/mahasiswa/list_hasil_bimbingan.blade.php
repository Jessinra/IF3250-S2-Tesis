    @extends('layouts.app')
@section('title', 'Hasil Bimbingan')

@section('content')
    <div class="container">
        <h3>Hasil Bimbingan</h3>

        <div class="row justify-content-center">
            <div class="add">
                <a class="btn btn-blue" href="/hasilbimbingan/tambah" role="button">
                    + Tambah
                </a>
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
                            Topik
                        </th>
                        <th>
                            Waktu Bimbingan
                        </th>
                        <th>
                            Status
                        </th>
                        <th></th>
                    </tr>
                </thead>

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

                        <td class="row">
                            <button class="btn btn-icon display-flex justify-content-center align-items-center" data-toggle="modal" data-target="#hsl{{$loop->iteration}}">
                                <i class="material-icons font-size-18-px">
                                    search
                                </i>
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
                            @if($item->status <= 0)

                            <form action="" method="post" id="form-id-bimbingan{{$item->id}}">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$item->id}}">
                            </form>
                            <form action="" method="post" id="form-del-id-bimbingan{{$item->id}}">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="-{{$item->id}}">
                            </form>
                            <button type="submit" form="form-id-bimbingan{{$item->id}}" class="btn btn-icon display-flex justify-content-center align-items-center">
                                <i class="material-icons font-size-18-px">
                                    edit
                                </i>
                            </button>
                            <button type="submit" form="form-del-id-bimbingan{{$item->id}}" class="btn btn-icon display-flex justify-content-center align-items-center">
                                <i class="material-icons font-size-18-px">
                                    delete
                                </i>
                            </button>

                            @endif
                        </td>

                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection