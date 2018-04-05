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
                            <a href="/hasilbimbingan/{{$item->id}}">
                                <button class="btn btn-primary display-flex justify-content-center align-items-center">
                                    <i class="material-icons font-size-18-px">
                                        edit
                                    </i>
                                    <span class="ml-1">Edit</span>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection