@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>

                <div class="card-body">
                    <form method="POST" action="/user/control/{{$user->username}}">
                        {{csrf_field()}}
                        @if(isset($success))
                        @if($success)
                            <div class="alert alert-success">
                                Perubahan berhasil disimpan
                            </div>
                        @else
                                <div class="alert alert-danger">
                                    Perubahan gagal disimpan
                                </div>
                        @endif
                        @endif
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="" value="{{$user->username}}" disabled>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email}}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->phone }}" >
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" optional>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" optional>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="row justify-content-center display-flex width-full">
                                <button type="submit" class="btn btn-primary display-flex justify-content-center align-items-center">
                                    <i class="material-icons font-size-18-px mr-2">
                                        save
                                    </i>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            @if(Auth::user()->isManajer())
            <div class="card">
                <div class="card-header">Edit Mahasiswa</div>

                <div class="card-body">
                    @if($mhs = $user->isMahasiswa())
                        <form action="/mahasiswa/edit/{{$user->id}}" method="post">
                            {{csrf_field()}}
                            @if(isset($success_status))
                                @if($success_status)
                                    <div class="alert alert-success">
                                        Perubahan berhasil disimpan
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        Perubahan gagal disimpan
                                    </div>
                                @endif
                            @endif
                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
                                <select class="mr-4" name="status" id="status" >
                                    @foreach($mhs->statusString as $key=>$val)
                                        <option value="{{$key}}" @if($mhs->status == $key) selected @endif >{{$key}} - {{$val}}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-blue">Submit</button>
                            </div>
                        </form>
                    @else
                        <div class="">
                            <div class="row justify-content-center">
                        User ini tidak memiliki role Mahasiswa
                            </div>
                            <div class="row justify-content-center">
                                <form action="/addrole/mahasiswa/{{$user->id}}" method="post">
                                    {{csrf_field()}}
                                <button class="btn btn-green justify-content-center align-items-center display-flex">
                            <i class="material-icons font-size-18-px">add_circle</i>
                            Tambah Role Mahasiswa
                                </button>
                                </form>
                            </div>
                    </div>
                    @endif

                </div>
            </div>
                <br>
                <div class="card">
                    <div class="card-header">Edit Dosen</div>

                    <div class="card-body">
                        @if($dosen = $user->isDosen())
                            User ini memiliki role Dosen

                            <form action="/dosen/edit/{{$user->id}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
                                    <select class="mr-4" name="status" id="status" >
                                        <option value="1" @if($dosen->status == 1) selected @endif>Dosen Penguji 2</option>
                                        <option value="2" @if($dosen->status == 2) selected @endif>Dosen Penguji 1</option>
                                        <option value="3" @if($dosen->status == 3) selected @endif>Dosen Pembimbing 2</option>
                                        <option value="4" @if($dosen->status == 4) selected @endif>Dosen Pembimbing 1</option>
                                    </select>
                                    <button class="btn btn-blue">Submit</button>
                                </div>
                            </form>
                        @else
                            <div class="">
                                <div class="row justify-content-center">
                                    User ini tidak memiliki role Dosen
                                </div>
                                <div class="row justify-content-center">
                                    <form action="/addrole/dosen/{{$user->id}}" method="post">
                                        {{csrf_field()}}
                                    <button class="btn btn-green justify-content-center align-items-center display-flex">
                                        <i class="material-icons font-size-18-px">add_circle</i>
                                        Tambah Role Dosen
                                    </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">Edit Manajer</div>

                    <div class="card-body">
                        @if($user->isManajer())
                            <div class="row justify-content-center">
                            User ini telah memiliki role Manajer
                            </div>
                        @else
                            <div class="">
                                <div class="row justify-content-center">
                                    User ini tidak memiliki role Manajer
                                </div>
                                <div class="row justify-content-center">
                                    {{csrf_field()}}
                                    <form action="/addrole/manajer/{{$user->id}}" method="post">
                                        <button class="btn btn-green justify-content-center align-items-center display-flex">
                                            <i class="material-icons font-size-18-px">add_circle</i>
                                            Tambah Role Dosen
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            @endif
        </div>
    </div>
</div>
@endsection
