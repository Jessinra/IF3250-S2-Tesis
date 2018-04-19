@extends('layouts.app')
@section('title')
    Dashboard Manajer
@endsection


@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-xs-6 col-lg-3 text-center">
                <a href="/mahasiswa/control" class="thumbnail">
                    <div>
                        <i class="material-icons icon-style">group</i>
                    </div>

                    Kontrol Mahasiswa
                </a>
            </div>

            <div class="col-xs-6 col-lg-3 text-center">
                <a href="/register" class="thumbnail">
                    <div>
                        <i class="material-icons icon-style">person_add</i>
                    </div>

                    Register Akun
                </a>
            </div>

            <div class="col-xs-6 col-lg-3 text-center">
                <a href="/mahasiswa/nilaiakhir" class="thumbnail">
                    <div>
                        <i class="material-icons icon-style">school</i>
                    </div>

                    Rekap Nilai Akhir Mahasiswa
                </a>
            </div>

            <div class="col-xs-6 col-lg-3 text-center">
                <a href="/mahasiswa/rekap" class="thumbnail">
                    <div>
                        <i class="material-icons icon-style">poll</i>
                    </div>

                    Rekap Perkembangan Mahasiswa
                </a>
            </div>

            <div class="col-xs-6 col-lg-3 text-center">
                <a href="/kelastesis" class="thumbnail">
                    <div>
                        <i class="material-icons icon-style">class</i>
                    </div>

                    Kelas Tesis
                </a>
            </div>

            <div class="col-xs-6 col-lg-3 text-center">
                <a href="/kontrolpanel" class="thumbnail">
                    <div>
                        <i class="material-icons icon-style">build</i>
                    </div>

                    Kontrol Panel
                </a>
            </div>
        </div>

    </div>
@endsection
