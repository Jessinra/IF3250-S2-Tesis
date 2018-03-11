@extends('layouts.app')

@section('title','403 Forbidden')

@section('content')
    <div class="container error-container">
        <h1 class="text-color-primary text-center title-big">MOHON MAAF</h1>
        <h3 class="message text-center">
            Akun anda tidak memiliki akses pada halaman ini
        </h3>
        <button onclick="backpage()" class="form-control button btn btn-primary">
            <i class="material-icons md-24">keyboard_arrow_left</i>

            Back
        </button>
    </div>
    <script>
        function backpage() {
            window.history.back();
        }
    </script>
@endsection