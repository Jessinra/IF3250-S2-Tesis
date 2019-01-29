@extends('layouts.app')
@section('title', 'Topic')


@section('content')
    <div class="container">
        <h3>Daftar Pengguna Aktif</h3>
        <div class="row justify-content-center table-x">
            <table class="table">
                <tr>
                    <th>
                        ID.
                    </th>
                    <th>
                        Username
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Role
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                @foreach(App\User::get() as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{$item->name}}</td>
                        <td>@if($item->isMahasiswa())Mahasiswa <br>@endif @if($item->isDosen()) Dosen <br> @endif @if($item->isManajer()) Manajer @endif</td>
                        <td>
                            <form action="/user/control/{{$item->username}}">
                            <button class="btn btn-blue display-flex justify-content-center align-items-center">
                                <i class="material-icons font-size-18px">edit</i>
                                Edit
                            </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection