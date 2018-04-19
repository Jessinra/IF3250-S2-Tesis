@extends('layouts.app')
@section('title', 'Hasil Bimbingan')

@section('content')
    <div class="container">
        <h3>Hasil Bimbingan</h3>

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
                            <input type="text" id="tahun" name="tahun" class="form-control col-md-8 " value="" required>
                        </td>
                        <td>
                            <input type="text" id="semester" name="semester" class="form-control col-md-8 " value="" required>
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
                        ID Kelas
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
                            {{$item->id}}
                        </td>
                        <td>
                            {{$item->tahun}}
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