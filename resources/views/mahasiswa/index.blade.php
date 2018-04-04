@extends('layouts.app')
@section('title')Dashboard Mahasiswa @endsection
@php
    $user = Auth::user();
    $mahasiswa = Auth::user()->isMahasiswa();
@endphp
@section('content')
    <div class="container dashboard-mahasiswa">
        <h1 class="header">Your Progress</h1>

        <div class="progress_containter">
            <div class="level_progress">
                @if($mahasiswa->status >= 4)
                    <div class="progress progress_1">
                        <div class="bar done"></div>
                    </div>
                @elseif($mahasiswa->status >=2)
                    <div class="progress progress_1">
                        <div class="bar prog60"></div>
                    </div>
                @elseif($mahasiswa->status >=1)
                    <div class="progress progress_1">
                        <div class="bar prog30"></div>
                    </div>
                @else
                    <div class="progress progress_1">
                        <div class="bar"></div>
                    </div>
                @endif

                @if($mahasiswa->status >= 9)
                    <div class="progress progress_2">
                        <div class="bar done"></div>
                    </div>
                @elseif($mahasiswa->status >=7)
                    <div class="progress progress_2">
                        <div class="bar prog60"></div>
                    </div>
                @elseif($mahasiswa->status >= 6)
                    <div class="progress progress_2">
                        <div class="bar prog30"></div>
                    </div>
                @else
                    <div class="progress progress_2">
                        <div class="bar"></div>
                    </div>
                @endif
                <div class="progress progress_3">
                    <div class="bar"></div>
                </div>


                <div class="level level_1 level_reached"><p>1</p></div>

                @if($mahasiswa->status >= 5)
                    <div class="level level_2 reached"><p>2</p></div>
                @else
                    <div class="level level_2"><p>2</p></div>
                @endif

                @if($mahasiswa->status >= 10)
                    <div class="level level_3 reached"><p>2</p></div>
                @else
                    <div class="level level_3"><p>2</p></div>
                @endif

                @if($mahasiswa->status >= 14)
                    <div class="level level_4 reached"><p>2</p></div>
                @else
                    <div class="level level_4"><p>2</p></div>
                @endif

                <div class="nav" role="tablist">
                    <a class="nav-link" data-toggle="tab" href="#step1">
                        <div class="level_text level1_text">
                            <p>Seminar Topik</p>
                        </div>
                    </a>
                    <a class="nav-link" data-toggle="tab" href="#step2">
                        <div class="level_text level2_text">
                            <p>Seminar Proposal</p>
                        </div>
                    </a>
                    <a class="nav-link" data-toggle="tab" href="#step3">
                        <div class="level_text level3_text">
                            <p>Seminar Tesis</p>
                        </div>
                    </a>
                    <a class="nav-link" data-toggle="tab" href="#step4">
                        <div class="level_text level4_text">
                            <p>Sidang Tesis</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div id="step1" class="container tab-pane fade active show">
                <h3 class="header">Seminar Topik</h3>
                
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div id="step2" class="container tab-pane fade">
                <h3 class="header">Seminar Proposal</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div id="step3" class="container tab-pane fade">
                <h3 class="header">Seminar Tesis</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
            <div id="step4" class="container tab-pane fade">
                <h3 class="header">Sidang Tesis</h3>
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
            </div>
        </div>


    <!--div class="user-section row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-color-white">{{$user->name}}</h2>
                <h3 class="text-center text-color-white">{{$user->username}}</h3>
            </div>
        </div-->
    </div>
@endsection
@section('bottomjs')
    <script>

    </script>
@endsection
