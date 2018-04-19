@extends('layouts.app')
@section('title')
    Rekap Data Mahasiswa
@endsection


@section('content')
    <div class="container">
        <h1>Rekap Perkembangan Mahasiswa</h1>
        <div class="row rekap-table">
            <div class="row justify-content-center left table-responsive">
                <table class="rekap-name-table table table-hover">
                    <col width="30">
                    <col width="60">
                    <col width="210">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama</th>
                    </tr>

                    <tr>
                        <td class="dummy" scope="col" height="92"></td>
                        <td class="dummy" scope="col" height="92"></td>
                        <td class="dummy" scope="col" height="92"></td>
                    </tr>

                    @foreach($mahasiswa as $item)
                        <tr>
                            <td scope="col">{{$loop->iteration}}</td>
                            <td scope="col">{{$item->user()->username}}</td>
                            <td scope="col">{{$item->user()->name}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>


            <div class="row justify-content-center table-responsive right">
                <table class="mahasiswa-control-table table table-hover">
                    <colgroup span="4"></colgroup>
                    <colgroup span="4"></colgroup>
                    <colgroup span="3"></colgroup>
                    <colgroup span="2"></colgroup>

                    <tr>
                        <th colspan="4" scope="colgroup">Seminar Topik</th>
                        <th colspan="4" scope="colgroup">Seminar Proposal</th>
                        <th colspan="3" scope="colgroup">Seminar Tesis</th>
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

                        <th scope="col">Masa Bimbingan</th>
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
                                <td height="47.2" class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_MENUNGGU_TOPIK ||
                                    $item->status == \App\Mahasiswa::STATUS_TOPIK_DITOLAK)
                                <td height="47.2" class="doing"></td>
                            @else
                                <td height="47.2" ></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_TOPIK_DITERIMA ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK ||
                                $item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                <td class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_TOPIK_TELAH_DIAJUKAN)
                                <td class="doing"></td>
                            @else
                                <td></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK ||
                                $item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                <td class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_TOPIK_DITERIMA)
                                <td class="doing"></td>
                            @else
                                <td></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TOPIK ||
                                $item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                <td class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TOPIK ||
                                    $item->status == \App\Mahasiswa::STATUS_SIAP_SEMINAR_TOPIK)
                                <td class="doing"></td>
                            @else
                                <td></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_PROPOSAL_TELAH_DIAJUKAN ||
                                $item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                <td class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_MENUNGGU_PROPOSAL)
                                <td class="doing"></td>
                            @else
                                <td></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_PROPOSAL_DITERIMA ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                <td class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_PROPOSAL_TELAH_DIAJUKAN ||
                                $item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITOLAK)
                                <td class="doing"></td>
                            @else
                                <td></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                <td class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_PROPOSAL_DITERIMA)
                                <td class="doing"></td>
                            @else
                                <td></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                <td class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_SIAP_SEMINAR_PROPOSAL ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_PROPOSAL)
                                <td class="doing"></td>
                            @else
                                <td></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_MASA_BIMBINGAN ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                <td class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_LULUS_SEMINAR_PROPOSAL)
                                <td class="doing"></td>
                            @else
                                <td></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_SIAP_SEMINAR_TESIS ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                <td class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_MASA_BIMBINGAN)
                                <td class="doing"></td>
                            @else
                                <td></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_LULUS_SEMINAR_TESIS)
                                <td class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_SIAP_SEMINAR_TESIS ||
                                $item->status == \App\Mahasiswa::STATUS_GAGAL_SEMINAR_TESIS)
                                <td class="doing"></td>
                            @else
                                <td></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_SIAP_SIDANG_TESIS)
                                <td class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_LULUS_SEMINAR_TESIS)
                                <td class="doing"></td>
                            @else
                                <td></td>
                            @endif

                            @if($item->status >= \App\Mahasiswa::STATUS_LULUS)
                                <td class="done"></td>
                            @elseif($item->status == \App\Mahasiswa::STATUS_SIAP_SIDANG_TESIS)
                                <td class="doing"></td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>


        </div>
    </div>
@endsection