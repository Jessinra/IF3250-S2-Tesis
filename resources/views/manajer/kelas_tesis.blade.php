@extends('layouts.app')
@section('title', 'Hasil Bimbingan')

@section('content')
    <div class="container">
        <h3>Daftar Kelas Tesis</h3>

        <div class="row justify-content-center table-x">

                <table class="mahasiswa-control-table">
                    <tr class="text-center">
                        <col width="300">
                        <col width="300">
                        <col width="300">
                        <th>
                            Tahun
                        </th>
                        <th>
                            Semester
                        </th>
                        <th>
                            Dosen
                        </th>
                        <th>

                        </th>
                    </tr>
                    <form action="/kelastesis/tambah" method="post">
                        {{csrf_field()}}
                    <tr>
                        <td>
                            <select type="text" id="tahun" class="form-control col-md-8" name="tahun">
                                <option value=""> </option>
                                @if(idate("m") > 6)
                                    <option value="{{idate("Y")}}">{{idate("Y")}}/{{idate("Y")+1}}</option>
                                @else
                                    <option value="{{idate("Y")}}">{{idate("Y")-1}}/{{idate("Y")}}</option>
                                @endif
                            </select>
                        </td>
                        <td>
                            <select type="text" id="semester" class="form-control col-md-8" name="semester">
                                <option value=""> </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </td>
                        <td>
                            <select type="text" id="dosen_id" class="form-control col-md-8" name="dosen_id">
                                <option value=" ">

                                </option>
                                @foreach($dosen as $item)
                                    <option value="{{$item->id}}">
                                        {{$item->user->name}}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-blue" type="submit">
                                + Tambah
                            </button>
                        </td>
                    </tr>
                    </form>
                </table>

        </div>
        <div class="row justify-content-center table-x">
            <table class="mahasiswa-control-table table table-hover">
                <thead>
                <tr class="text-center">
                    <th>
                        No
                    </th>
                    <th>
                        Tahun
                    </th>
                    <th>
                        Semester
                    </th>
                    <th>
                        Dosen
                    </th>
                </tr>
                </thead>

                @foreach($kelas_tesis as $item)
                    <tr class="text-center">
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            @if($item->semester == 1)
                                {{$item->tahun}}/{{$item->tahun+1}}
                            @else
                                {{$item->tahun-1}}/{{$item->tahun}}
                            @endif

                        </td>
                        <td>
                            {{$item->semester}}
                        </td>
                        <td>
                            {{$item->dosenKelas->user->name}}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection