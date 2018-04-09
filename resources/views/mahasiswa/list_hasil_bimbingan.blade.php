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