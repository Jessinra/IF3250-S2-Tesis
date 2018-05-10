@extends('layouts.app')
@section('title')
    Rekap Data Mahasiswa
@endsection


@section('content')
    <div class="container">
        <h1>Rekap Perkembangan Mahasiswa</h1>
        <div class="btns">
            <button class="advancer-btn btn-primary paddle hidden left-btn">
                <
            </button>
            <button class="advancer-btn btn-primary paddle right-btn">
                >
            </button>
        </div>

        <div class="row rekap-table">
            <div class="row justify-content-center left table-responsive">
                <table class="rekap-name-table table table-hover">
                    <col width="30">
                    <col width="60">
                    <col >
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIM</th>
                        <th >Nama</th>
                    </tr>

                    <tr>
                        <td class="dummy" scope="col" height="90.67"></td>
                        <td class="dummy" scope="col" height="90.67"></td>
                        <td class="dummy" height="90.67"></td>
                    </tr>

                    @foreach($mahasiswa as $item)
                        <tr>
                            <td scope="col">{{$loop->iteration}}</td>
                            <td scope="col">{{$item->user()->username}}</td>
                            <td >{{$item->user()->name}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="progress-mhs row justify-content-center table-responsive right">
                <table class="rekap-table table table-hover table-bordered">
                    <colgroup span="4"></colgroup>
                    <colgroup span="4"></colgroup>
                    <colgroup span="2"></colgroup>
                    <colgroup span="2"></colgroup>

                    <tr>
                        <th colspan="4" scope="colgroup">Seminar Topik</th>
                        <th colspan="4" scope="colgroup">Seminar Proposal</th>
                        <th colspan="2" scope="colgroup">Seminar Tesis</th>
                        <th colspan="2" scope="colgroup">Sidang Tesis</th>
                    </tr>
                    <tr>
                        <th scope="col">Topik Diajukan</th>
                        <th scope="col">Topik Disetujui</th>
                        <th scope="col">Siap Seminar Topik</th>
                        <th scope="col">Lulus Seminar Topik</th>

                        <th scope="col">Proposal Diajukan</th>
                        <th scope="col">Proposal Diterima</th>
                        <th scope="col">Siap Seminar Proposal</th>
                        <th scope="col">Lulus Seminar Proposal</th>

                        {{--<th scope="col">Masa Bimbingan</th>--}}
                        <th scope="col">Siap Seminar Tesis</th>
                        <th scope="col">Lulus Seminar Tesis</th>

                        <th scope="col">Siap Sidang Tesis</th>
                        <th scope="col">Lulus</th>
                    </tr>
                    @foreach($mahasiswa as $item)
                        <tr>
                            @if($item->status >= \App\Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK ||
                                $item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                @if($item->t_topik1 == null)
                                    <td height="46.22" width="110" class="done-rekap"></td>
                                @else
                                    <td height="46.22" width="110" class="done-rekap">{{date('d-m-Y',strtotime($item->t_topik1))}}</td>
                                @endif
                            @elseif($item->status == \App\Mahasiswa::STATUS_MENUNGGU_TOPIK ||
                                    $item->status == \App\Mahasiswa::STATUS_TOPIK_DITOLAK)
                                <td height="46.22" width="110" class="doing"></td>
                            @else
                                <td height="46.22" width="110"></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_TOPIK_DITERIMA ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK ||
                                $item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                @if($item->t_topik2 == null)
                                    <td width="110" class="done-rekap"></td>
                                @else
                                    <td width="110" class="done-rekap">{{date('d-m-Y',strtotime($item->t_topik2))}}</td>
                                @endif

                            @elseif($item->status == \App\Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN)
                                <td width="110" class="doing"></td>
                            @else
                                <td width="110"></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK ||
                                $item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)

                                @if($item->t_topik3 == null)
                                    <td width="110" class="done-rekap"></td>
                                @else
                                    <td width="110" class="done-rekap">{{date('d-m-Y',strtotime($item->t_topik3))}}</td>
                                @endif
                            @elseif($item->status == \App\Mahasiswa::STATUS_TOPIK_DITERIMA)
                                <td width="110" class="doing"></td>
                            @else
                                <td width="110"></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK ||
                                $item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)

                                @if($item->t_topik4 == null)
                                    <td width="110" class="done-rekap"></td>
                                @else
                                    <td width="110" class="done-rekap">{{date('d-m-Y',strtotime($item->t_topik4))}}</td>
                                @endif
                            @elseif($item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK ||
                                    $item->status == \App\Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK)
                                <td width="110" class="doing"></td>
                            @else
                                <td width="110"></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_PROPOSAL_TELAH_DIAJUKAN ||
                                $item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)

                                @if($item->t_proposal1 == null)
                                    <td width="110" class="done-rekap"></td>
                                @else
                                    <td width="110" class="done-rekap">{{date('d-m-Y',strtotime($item->t_proposal1))}}</td>
                                @endif
                            @elseif($item->status == \App\Mahasiswa::STATUS_MENUNGGU_PROPOSAL)
                                <td width="110" class="doing"></td>
                            @else
                                <td width="110"></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_PROPOSAL_DITERIMA ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)

                                @if($item->t_proposal2 == null)
                                    <td width="110" class="done-rekap"></td>
                                @else
                                    <td width="110" class="done-rekap">{{date('d-m-Y',strtotime($item->t_proposal2))}}</td>
                                @endif
                            @elseif($item->status == \App\Mahasiswa::STATUS_PROPOSAL_TELAH_DIAJUKAN ||
                                $item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK)
                                <td width="110" class="doing"></td>
                            @else
                                <td width="110"></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)

                                @if($item->t_proposal3 == null)
                                    <td width="110" class="done-rekap"></td>
                                @else
                                    <td width="110" class="done-rekap">{{date('d-m-Y',strtotime($item->t_proposal3))}}</td>
                                @endif
                            @elseif($item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITERIMA)
                                <td width="110" class="doing"></td>
                            @else
                                <td width="110"></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)

                                @if($item->t_proposal4 == null)
                                    <td width="110" class="done-rekap"></td>
                                @else
                                    <td width="110" class="done-rekap">{{date('d-m-Y',strtotime($item->t_proposal4))}}</td>
                                @endif
                            @elseif($item->status == \App\Mahasiswa::STATUS_SIAP_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL)
                                <td width="110" class="doing"></td>
                            @else
                                <td width="110"></td>
                            @endif

                            {{--@if($item->status >= \App\Mahasiswa::STATUS_MASA_BIMBINGAN ||--}}
                                {{--$item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)--}}
                                {{--<td class="done"></td>--}}
                            {{--@elseif($item->status == \App\Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL)--}}
                                {{--<td class="doing"></td>--}}
                            {{--@else--}}
                                {{--<td></td>--}}
                            {{--@endif--}}

                            @if($item->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_TESIS ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)

                                @if($item->t_seminar1 == null)
                                    <td width="110" class="done-rekap"></td>
                                @else
                                    <td width="110" class="done-rekap">{{date('d-m-Y',strtotime($item->t_seminar1))}}</td>
                                @endif
                            @elseif($item->status == \App\Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL ||
                                    $item->status == \App\Mahasiswa::STATUS_MASA_BIMBINGAN)
                                <td width="110" class="doing"></td>
                            @else
                                <td width="110"></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TESIS)
                                @if($item->t_seminar2 == null)
                                    <td width="110" class="done-rekap"></td>
                                @else
                                    <td width="110" class="done-rekap">{{date('d-m-Y',strtotime($item->t_seminar2))}}</td>
                                @endif
                            @elseif($item->status == \App\Mahasiswa::STATUS_SIAP_SEMINAR_TESIS ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                <td width="110" class="doing"></td>
                            @else
                                <td width="110"></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_SIAP_SIDANG_TESIS)
                                @if($item->t_sidang == null)
                                    <td width="110" class="done-rekap"></td>
                                @else
                                    <td width="110" class="done-rekap">{{date('d-m-Y',strtotime($item->t_sidang))}}</td>
                                @endif
                            @elseif($item->status == \App\Mahasiswa::STATUS_LULUS_SEMINAR_TESIS)
                                <td width="110" class="doing"></td>
                            @else
                                <td width="110"></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_LULUS)
                                @if($item->t_lulus == null)
                                    <td width="110" class="done-rekap"></td>
                                @else
                                    <td width="110" class="done-rekap">{{date('d-m-Y',strtotime($item->t_lulus))}}</td>
                                @endif
                            @elseif($item->status == \App\Mahasiswa::STATUS_SIAP_SIDANG_TESIS)
                                <td width="110" class="doing"></td>
                            @else
                                <td width="110"></td>
                            @endif
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
@endsection

@section('bottomjs')
    <script>
        var scrollDuration = 400;

        var leftPaddle = document.getElementsByClassName('left-btn');
        var rightPaddle = document.getElementsByClassName('right-btn');
        var menuWrapperSize = 700;

        var menuSize = 1400;
        // get how much of menu is invisible
        var menuInvisibleSize = menuSize - menuWrapperSize;

        // scroll to left
        $(rightPaddle).on('click', function() {
            $('.progress-mhs').animate( { scrollLeft: menuInvisibleSize}, scrollDuration);
        });

        // scroll to right
        $(leftPaddle).on('click', function() {
            $('.progress-mhs').animate( { scrollLeft: '0' }, scrollDuration);
        });
    </script>
@endsection