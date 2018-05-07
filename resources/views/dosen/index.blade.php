@extends('layouts.app')
@section('title')Dashboard Dosen @endsection

@section('content')
<?php
    $state = 0;
?>
<script>
	var statejs = "<?php echo $state; ?>"
	function Button_Click() {
    document.getElementById('buttondetail').value = statejs;
        statejs = 1;
}
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container"> 
		@php($cuser = Auth::user())
		@php($dosen = $cuser->isDosen())
	  	<div class="row">
			<div class="col col-md-6">
			  	<!-- Nav tabs -->
			  	<!-- <ul class="nav nav-tabs" role="tablist">
			    	<li class="nav-item">
			      		<a class="nav-link active" data-toggle="tab" href="#home">Daftar Mahasiswa</a>
			    	</li>
			    	<li class="nav-item">
			      		<a class="nav-link" data-toggle="tab" href="#menu1">Input Nilai Dosen Tesis</a>
			    	</li>
			    	<li class="nav-item">
			      		<a class="nav-link" data-toggle="tab" href="#menu2">Input Nilai</a>
			    	</li>
			  	</ul> -->



	  			<!-- Tab panes -->
	  	
			  	<!-- <div class="tab-content"> -->
			    	<!-- <div id="home" class="container tab-pane active"><br> -->
			      		<!-- <div class="row">
					  		<div class="col"> -->
					  			<h3>Daftar Mahasiswa</h3>

					  			<hr/>
					  			<div id="accordion">
									@if(count($kelas) > 0)
									<div class="card">
						      			<div class="card-header">
						        			<a class="card-link" data-toggle="collapse" href="#collapseThree">
						          				Mahasiswa Kelas Tesis
						        			</a>
						      			</div>
						      			<div id="collapseThree" class="collapse show" data-parent="#accordion">
						        			<div class="card-body">
											<div class="row justify-content-center">
							                		<table class="mahasiswa-control-table width-full table table-hover">
							                			<thead>
										                    <tr class="text-center">
										                        <th>
										                            No
										                        </th>
										                        <th>
										                            Nama
										                        </th>
										                        <th>
										                            NIM
										                        </th>
										                        <!-- <th>
										                            Status
										                        </th> -->
										                        <th></th>
										                    </tr>
										                </thead>
										                @foreach($mahasiswakelas as $item)
										                    @php($user = $item->user())
                                                            @if($item->id_kelas_tesis != null)
                                                            @if($item->kelasTesis->id_dosen_kelas == $dosen->id)
										                    <tr class="text-center" >
										                    <td>
										                        {{$loop->iteration}}
										                    </td>
										                        <td>
										                            {{$user->name}}
										                        </td>
										                        <td>
										                            {{$user->username}}
										                        </td>
										                        <!-- <td>
										                            {{$item->getStatusString()}}
										                        </td> -->
										                        <td>
										                            <div class="display-flex justify-content-start align-items-center">
																	@php($tesis = $item->tesis())
																	@php($st = $tesis->sidangTesis())																	
																		@if(!is_null($st->nilai_dosen_kelas_utama))
																		<button class="btn btn-grey" data-toggle="modal" data-target="#kelas{{$loop->iteration}}">
																			Nilai
																		</button>
																		@else
																		<button class="btn btn-green" data-toggle="modal" data-target="#kelas{{$loop->iteration}}">
																			Nilai
        	        													</button>
																		@endif
																	</div>

																	<div class="modal fade" id="kelas{{$loop->iteration}}">
																	<div class="modal-dialog">
																		<div class="modal-content">

																			<!-- Modal Header -->
																			<div class="modal-header">
																				<h4 class="modal-title">Penilaian Sidang: {{$user->name}}</h4>
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																			</div>

																			<!-- Modal body -->
																			<div class="modal-body">
																			<form action="/sidangtesis/nilai/{{$user->username}}" method="post" class="width-full">
																			{{csrf_field()}}

																			@if(!is_null($st->nilai_dosen_kelas_utama))
																				<div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
																					<i class="material-icons font-size-18-px mr-2">check_circle</i>
																					Anda telah melakukan penilaian terhadap mahasiswa yang bersangkutan silakan hubungi Admin untuk perubahan nilai.
																				</div>
																				<fieldset disabled="disabled">
																			@endif
																				<input type="hidden" value="{{$user->username}}" name="mahasiswa">
																				<div class="form-group row width-full justify-content-center">
																					<label for="scoreIndexUtama" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Utama</label>
																					<select class="form-control col-sm-2 ml-1 mr-1" name="scoreUtama" id="scoreIndexUtama">
																						@if($st->nilai_dosen_kelas_utama == "L")
																							<option selected ="selected" value="L">B</option>
																						@elseif ($st->nilai_dosen_kelas_utama == "M")
																							<option selected ="selected" value="M">C</option>
																						@elseif ($st->nilai_dosen_kelas_utama == "K")
																							<option selected ="selected" value="K">K</option>
																						@else
																							<option value="L">B</option>
																							<option value="M">C</option>
																							<option value="K">K</option>
																						@endif
																					</select>
																				</div>
																			<div class="form-group row width-full justify-content-center">
																				<button  class="col-md-4 btn btn-blue ml-1 mr-1">
																						Tetapkan
																				</button>
																			</div>
                                                                                </fieldset>
                                                                            </form>

																			</div>
	



																			<!-- Modal footer -->
																			<div class="modal-footer">
																				<button type="submit" class="btn btn-danger" data-dismiss="modal">Tutup</button>
																			</div>

																		</div>
																	</div>
																</div>
										                        </td>
										                    </tr>
                                                            @endif
                                                            @endif
										                @endforeach
										            </table>
											</div>
										</div>
									</div>
                                    </div>
									@endif


						    		<div class="card">
						      			<div class="card-header">
						        			<a class="card-link" data-toggle="collapse" href="#collapseOne">
						          				Mahasiswa Bimbingan
						        			</a>
						      			</div>
						      			<div id="collapseOne" class="collapse" data-parent="#accordion">
						        			<div class="card-body">
							               		<div class="row justify-content-center">
							                		<table class="mahasiswa-control-table width-full table table-hover">
							                			<thead>
										                    <tr class="text-center">
										                        <th>
										                            No
										                        </th>
										                        <th>
										                            Nama
										                        </th>
										                        <th>
										                            NIM
										                        </th>
										                        <!-- <th>
										                            Status
										                        </th> -->
										                        <th></th>
										                    </tr>
										                </thead>
										                @foreach($mahasiswabimbingan as $item)
										                    @php($user = $item->user())
										                     <tr class="text-center" >
										                    <td>
										                        {{$loop->iteration}}
										                    </td>
										                        <td>
										                            {{$user->name}}
										                        </td>
										                        <td>
										                            {{$user->username}}
										                        </td>
										                        <!-- <td>
										                            {{$item->getStatusString()}}
										                        </td> -->
										                        <td>
										                            <a href="/dosen/mahasiswa-control/{{$user->username}}" class="text-decoration-none">
										                                <button class="btn btn-icon display-flex justify-content-center align-items-center" id="buttondetail" onClick="Button_Click()">
										                                   <!--  <i class="text-decoration-none material-icons mr-2">remove_red_eye</i> -->
										                                    <i class="material-icons font-size-18-px">
									                                            search
									                                        </i>
										                                </button>
										                            </a>
										                        </td>
										                    </tr>
										                @endforeach
										            </table>
										            <a class="btn btn-blue" href="/hasilbimbingan" role="button">Lihat Seluruh Jadwal Bimbingan</a>
							                	</div>
						        			</div>
						      			</div>
						    		</div>

						    		<div class="card">
						      			<div class="card-header">
						        			<a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
						        				Mahasiswa Uji
						      				</a>
						      			</div>
						      			<div id="collapseTwo" class="collapse" data-parent="#accordion">
						        			<div class="card-body">

												@foreach($dosen->sidangTesisNeedApproval() as $st)
													@if(($st->ajuan_penguji1 == $cuser->id  && !$st->approval_penguji1) || ($st->ajuan_penguji2 == $cuser->id  && !$st->approval_penguji2) || ($st->ajuan_penguji3 == $cuser->id  && !$st->approval_penguji3))
													@php($tesis = $st->tesis)
													@php($mhs = $tesis->mahasiswa)
													@php($usr = $mhs->user())
													<div class="border border-color-black pt-1 pr-1 pl-1 pb-1">
														<div class="row">
															<table class="col-md-8">
																<tr>
																	<td>
																		Mahasiswa
																	</td>
																	<td>
																		:
																	</td>
																	<td>
																		{{$usr->name}}
																	</td>
																</tr>
															<tr>
																<td>
																	Jadwal
																</td>
																<td>
																	:
																</td>
																<td>
																	{{date("d M Y H:iA", strtotime($st->tanggal.'T'.$st->jam.'UTC'))}}
																</td>
															</tr>

															<tr>
																<td>
																	Tempat
																</td>
																<td>
																	:
																</td>
																<td>
																  {{$st->tempat}}
																</td>
															</tr>
																<tr>
																	<td>
																		Judul Tesis
																	</td>
																	<td>
																		:
																	</td>
																	<td>
																		{{$tesis->topic}}
																	</td>
																</tr>
																<tr>
																	<td>
																		Dosen Pembimbing
																	</td>
																	<td>
																		:
																	</td>
																	<td>
																		{{$tesis->dosen_pembimbing_1->user->name}}
																	</td>
																</tr>
															</table>
															<div class="display-flex justify-content-start align-items-center">
																<form action="/sidangtesis/dosenuji/approve/{{$st->id}}" method="post">
																	{{csrf_field()}}
																	<input type="hidden" value="{{$cuser->id}}">
																	<button class="btn btn-blue">
																		Approve
																	</button>
																</form>
															</div>
														</div>
													</div>
													@endif
												@endforeach
						        			</div>

												@foreach($dosen->sidangTesisApproved() as $st)
													@if(($st->dosen_penguji_1 == $cuser->id) || ($st->dosen_penguji_2 == $cuser->id))
													@php($tesis = $st->tesis)
													@php($mhs = $tesis->mahasiswa)
													@php($usr = $mhs->user())
													<div class="card-body">
													<div class="border border-color-black pt-1 pr-1 pl-1 pb-1">
														<div class="row">
															<table class="col-md-8">
																<tr>
																	<td>
																		Mahasiswa
																	</td>
																	<td>
																		:
																	</td>
																	<td>
																		{{$usr->name}}
																	</td>
																</tr>
															<tr>
																<td>
																	Jadwal
																</td>
																<td>
																	:
																</td>
																<td>
																	{{date("d M Y H:iA", strtotime($st->tanggal.'T'.$st->jam.'UTC'))}}
																</td>
															</tr>

															<tr>
																<td>
																	Tempat
																</td>
																<td>
																	:
																</td>
																<td>
																  {{$st->tempat}}
																</td>
															</tr>
																<tr>
																	<td>
																		Judul Tesis
																	</td>
																	<td>
																		:
																	</td>
																	<td>
																		{{$tesis->topic}}
																	</td>
																</tr>
																<tr>
																	<td>
																		Dosen Pembimbing
																	</td>
																	<td>
																		:
																	</td>
																	<td>
																		{{$tesis->dosen_pembimbing_1->user->name}}
																	</td>
																</tr>
															</table>
															<div class="display-flex justify-content-start align-items-center">
																	@if($st->dosen_penguji_1 == $dosen->id)
																		@if(!is_null($st->nilai_dosen_penguji_1_utama))
																		<button class="btn btn-grey" data-toggle="modal" data-target="#uji{{$loop->iteration}}">
																			Nilai
																		</button>
																		@else
	`																	<button class="btn btn-green" data-toggle="modal" data-target="#uji{{$loop->iteration}}">
																			Nilai
        	        													</button>
																		@endif
																	@elseif($st->dosen_penguji_2 == $dosen->id)
																		@if(!is_null($st->nilai_dosen_penguji_2_utama))
																		<button class="btn btn-grey" data-toggle="modal" data-target="#uji{{$loop->iteration}}">
																			Nilai
																		</button>
																		@else
	`																	<button class="btn btn-green" data-toggle="modal" data-target="#uji{{$loop->iteration}}">
																			Nilai
        	        													</button>
																		@endif
																	@endif
																	
															

																<div class="modal fade" id="uji{{$loop->iteration}}">
																	<div class="modal-dialog">
																		<div class="modal-content">

																			<!-- Modal Header -->
																			<div class="modal-header">
																				<h4 class="modal-title">Penilaian Sidang: {{$usr->name}}</h4>
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																			</div>

																			<!-- Modal body -->
																			<div class="modal-body">
																			<form action="/sidangtesis/nilai/{{$usr->username}}" method="post" class="width-full">
																			{{csrf_field()}}

																			@if(!is_null($st->nilai_dosen_penguji_1_utama) && !is_null($st->nilai_dosen_penguji_2_utama))
																				<div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
																					<i class="material-icons font-size-18-px mr-2">check_circle</i>
																					Anda telah melakukan penilaian terhadap mahasiswa yang bersangkutan silakan hubungi Admin untuk perubahan nilai.
																				</div>
																				<fieldset disabled="disabled">
																			@endif
																			@if($st->dosen_penguji_1 ==  $dosen->id)
																				<input type="hidden" value="{{$usr->username}}" name="mahasiswa">
																				<div class="form-group row width-full justify-content-center">
																					<label for="scoreIndexUtama" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Utama</label>
																					<select class="form-control col-sm-2 ml-1 mr-1" name="scoreUtama" id="scoreIndexUtama">
																						@if($st->nilai_dosen_penguji_1_utama == "L")
																							<option selected ="selected" value="L">B</option>
																						@elseif ($st->nilai_dosen_penguji_1_utama == "M")
																							<option selected ="selected" value="M">C</option>
																						@elseif ($st->nilai_dosen_penguji_1_utama == "K")
																							<option selected ="selected" value="K">K</option>
																						@else
																							<option value="L">B</option>
																							<option value="M">C</option>
																							<option value="K">K</option>
																						@endif
																					</select>
																				</div>
																				<div class="form-group row width-full justify-content-center">
																					<label for="scoreIndexPenting" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Penting</label>
																					<select class="form-control col-sm-2 ml-1 mr-1" name="scorePenting" id="scoreIndexPenting"
																					>
																						@if($st->nilai_dosen_penguji_1_penting == "L")
																							<option selected ="selected" value="L">B</option>
																						@elseif ($st->nilai_dosen_penguji_1_penting == "M")
																							<option selected ="selected" value="M">C</option>
																						@elseif ($st->nilai_dosen_penguji_1_penting == "K")
																							<option selected ="selected" value="K">K</option>
																						@else
																							<option value="L">B</option>
																							<option value="M">C</option>
																							<option value="K">K</option>
																						@endif
																					</select>
																				</div>
																			<div class="form-group row width-full justify-content-center">
																				<label for="scoreIndexPendukung" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Pendukung</label>
																				<select class="form-control col-sm-2 ml-1 mr-1" name="scorePendukung" id="scoreIndexPendukung"
																				>
																					@if($st->nilai_dosen_penguji_1_pendukung == "L")
																						<option selected ="selected" value="L">B</option>
																					@elseif ($st->nilai_dosen_penguji_1_pendukung == "M")
																						<option selected ="selected" value="M">C</option>
																					@elseif ($st->nilai_dosen_penguji_1_pendukung == "K")
																						<option selected ="selected" value="K">K</option>
																					@else
																						<option value="L">B</option>
																						<option value="M">C</option>
																						<option value="K">K</option>
																					@endif
																				</select>
																			</div>
																			<div class="form-group row width-full justify-content-center">
																				<button  class="col-md-4 btn btn-blue ml-1 mr-1">
																						Tetapkan
																				</button>
																			</div>
																			</div>
																			@endif

																			@if($st->dosen_penguji_2 ==  $dosen->id)
																			@if(!is_null($st->nilai_dosen_penguji_2_utama))
																				<div class="alert alert-success row align-items-center flex-row display-flex flex-wrap-nowrap">
																					<i class="material-icons font-size-18-px mr-2">check_circle</i>
																					Anda telah melakukan penilaian terhadap mahasiswa yang bersangkutan silakan hubungi Admin untuk perubahan nilai.
																				</div>
																				<fieldset disabled="disabled">
																			@endif
																				<input type="hidden" value="{{$usr->username}}" name="mahasiswa">
																				<div class="form-group row width-full justify-content-center">
																					<label for="scoreIndexUtama" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Utama</label>
																					<select class="form-control col-sm-2 ml-1 mr-1" name="scoreUtama" id="scoreIndexUtama">
																						@if($st->nilai_dosen_penguji_2_utama == "L")
																							<option selected ="selected" value="L">B</option>
																						@elseif ($st->nilai_dosen_penguji_2_utama == "M")
																							<option selected ="selected" value="M">C</option>
																						@elseif ($st->nilai_dosen_penguji_2_utama == "K")
																							<option selected ="selected" value="K">K</option>
																						@else
																							<option value="L">B</option>
																							<option value="M">C</option>
																							<option value="K">K</option>
																						@endif
																					</select>
																				</div>
																				<div class="form-group row width-full justify-content-center">
																					<label for="scoreIndexPenting" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Penting</label>
																					<select class="form-control col-sm-2 ml-1 mr-1" name="scorePenting" id="scoreIndexPenting"
																					>
																						@if($st->nilai_dosen_penguji_2_penting == "L")
																							<option selected ="selected" value="L">B</option>
																						@elseif ($st->nilai_dosen_penguji_2_penting == "M")
																							<option selected ="selected" value="M">C</option>
																						@elseif ($st->nilai_dosen_penguji_2_penting == "K")
																							<option selected ="selected" value="K">K</option>
																						@else
																							<option value="L">B</option>
																							<option value="M">C</option>
																							<option value="K">K</option>
																						@endif
																					</select>
																				</div>
																			<div class="form-group row width-full justify-content-center">
																				<label for="scoreIndexPendukung" class=" col-sm-4 text-center col-form-label mr-1 ml-1">Nilai Komponen Pendukung</label>
																				<select class="form-control col-sm-2 ml-1 mr-1" name="scorePendukung" id="scoreIndexPendukung"
																				>
																					@if($st->nilai_dosen_penguji_2_pendukung == "L")
																						<option selected ="selected" value="L">B</option>
																					@elseif ($st->nilai_dosen_penguji_2_pendukung == "M")
																						<option selected ="selected" value="M">C</option>
																					@elseif ($st->nilai_dosen_penguji_2_pendukung == "K")
																						<option selected ="selected" value="K">K</option>
																					@else
																						<option value="L">B</option>
																						<option value="M">C</option>
																						<option value="K">K</option>
																					@endif
																				</select>
																			</div>
																			<div class="form-group row width-full justify-content-center">
																				<button  class="col-md-2 btn btn-blue ml-1 mr-1">
																						Tetapkan
																				</button>
																			</div>
																			</div>
																			@endif

																			</form>
																			</fieldset>

																			<!-- Modal footer -->
																			<div class="modal-footer">
																				<button type="submit" class="btn btn-danger" data-dismiss="modal">Tutup</button>
																			</div>
                                                                    </div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													@endif
												@endforeach
												</div>
						        			</div>
								      	</div>
								    </div>

                <div class="col col-md-6">
                    <!-- <h2>Jadwal Dosen</h2> -->


                    <!-- <h3>Jadwal</h3>
                    <hr/> -->
                    <h3>Jadwal</h3>
                    <hr/>

                    <div class="mt-5">
                        @php($currenttime = \Carbon\Carbon::now()->toDateString())
                        @foreach($mahasiswabimbingan as $item)
                            @php($user = $item->user())
                            @if($item->getHasilBimbingan()->count() > 0)
                                @php($jadwalbimbingan = \Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$item->gethasilBimbingan()[0]->waktu_bimbingan_selanjutnya))
                                @if($jadwalbimbingan >= $currenttime)
                                    <div class="row">
                                        <div class="col-md-4 text-center" style="border-right: 1px solid grey">
                                            <i class="fa fa-calendar-check-o mb-2" style="font-size:60px"></i>
                                            <div>{{$jadwalbimbingan->format('d M Y')}}</div>
                                        </div>
                                        <div class="col">
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <h5><span class="badge badge-info">Bimbingan</span></h5>
                                                    <h4>{{$user->name}} - {{$user->username}}</h4>
                                                    <h5>
                                                        <span class="badge badge-primary">Tempat: Ruang dosen</span>
                                                        <span class="badge badge-primary">Waktu: {{$jadwalbimbingan->format('g:i A')}}</span>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @if(!is_null($item->tesis()))
                                @php($seminar = $item->tesis()->seminarTesis())
                                @if(!is_null($seminar))
                                    @php($date = $seminar->hari)
                                    @php($time = $seminar->waktu)
                                    @if(!is_null($date) && !is_null($time))
                                        @php($datetimeString = $date." ".$time)
                                        @php($jadwalseminar = \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $datetimeString))
                                        @if($jadwalseminar >= $currenttime)
                                            <div class="row">
                                                <div class="col-md-4 text-center" style="border-right: 1px solid grey">
                                                    <i class="fa fa-calendar-check-o mb-2" style="font-size:60px"></i>
                                                    <div>{{$jadwalseminar->format('d M Y')}}</div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-4">
                                                        <div class="col">
                                                            <h5><span class="badge badge-warning text-color-white">Seminar Tesis</span></h5>
                                                            <h4>{{$user->name}} - {{$user->username}}</h4>
                                                            <h5>
                                                                <span class="badge badge-primary">Tempat: {{$seminar->tempat}}</span>
                                                                <span class="badge badge-primary">Waktu: {{$jadwalseminar->format('g:i A')}}</span>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endforeach
                        @foreach($dosen->upcomingSidangAsPenguji1 as $st)
                            @php($user = $st->tesis->mahasiswa->user())
                            @if($st->tanggal.'T'.$st->waktu >= $currenttime)
                                <div class="row">
                                    <div class="col-md-4 text-center" style="border-right: 1px solid grey">
                                        <i class="fa fa-calendar-check-o mb-2" style="font-size:60px"></i>
                                        <div>{{date("d M Y", strtotime($st->tanggal.'T'.$st->jam.'UTC'))}}</div>
                                    </div>
                                    <div class="col">
                                        <div class="row mb-4">
                                            <div class="col">
                                                @php($tsis = $st->tesis)
                                                @php($useruji = $tsis->mahasiswa->user())
                                                <h5><span class="badge badge-success">Sidang Tesis</span></h5>
                                                <h4>{{$useruji->name}} - {{$useruji->username}}</h4>
                                                <h6>
                                                    Topik: {{$st->tesis->topic}} <br>
                                                    Dosen Pembimbing 1 : {{$st->tesis->dosen_pembimbing_1->user->name}}
                                                    <br>
                                                    @if($st->tesis->dosen_pembimbing_2)
                                                        Dosen Pembimbing 2 : {{$st->tesis->dosen_pembimbing_2->user->name}}
                                                    @endif
                                                    <br>
                                                    Dosen Penguji 1 : {{$st->dosen_penguji1->name}}
                                                    <br>
                                                    Dosen Penguji 2 : {{$st->dosen_penguji2->name}}
                                                </h6>
                                                <h5>
                                                    <span class="badge badge-primary">Tempat: {{$st->tempat}}</span>
                                                    <span class="badge badge-primary">Waktu: {{date("g:i A",strtotime($st->waktu))}}</span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @foreach($dosen->upcomingSidangAsPenguji2 as $st)
                            @php($user = $st->tesis->mahasiswa->user())
                            @if($st->tanggal.'T'.$st->waktu >= $currenttime)
                                <div class="row">
                                    <div class="col-md-4 text-center" style="border-right: 1px solid grey">
                                        <i class="fa fa-calendar-check-o mb-2" style="font-size:60px"></i>
                                        <div>{{date("d M Y", strtotime($st->tanggal.'T'.$st->jam.'UTC'))}}</div>
                                    </div>
                                    <div class="col">
                                        <div class="row mb-4">
                                            <div class="col">
                                                @php($tsis2 = App\Thesis::where('id', $st->thesis_id)->first())
                                                @php($useruji2 = App\Mahasiswa::where('id', $tsis2->mahasiswa_id)->first()->user())
                                                <h5><span class="badge badge-success">Sidang Tesis</span></h5>
                                                <h4>{{$useruji2->name}} - {{$useruji2->username}}</h4>
                                                <h6>
                                                    Topik: {{$st->tesis->topic}} <br>
                                                    Dosen Pembimbing 1 : {{$st->tesis->dosen_pembimbing_1->user->name}}
                                                    <br>
                                                    @if($st->tesis->dosen_pembimbing_2)
                                                        Dosen Pembimbing 2 : {{$st->tesis->dosen_pembimbing_2->user->name}}
                                                    @endif
                                                    <br>
                                                    Dosen Penguji 1 : {{$st->dosen_penguji1->name}}
                                                    <br>
                                                    Dosen Penguji 2 : {{$st->dosen_penguji2->name}}
                                                </h6>
                                                <h5>
                                                    <span class="badge badge-primary">Tempat: {{$st->tempat}}</span>
                                                    <span class="badge badge-primary">Waktu: {{date("g:i A",strtotime($st->waktu))}}</span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
						  		</div>

					  		<!-- </div> -->

					<!-- </div> -->
			    <!-- </div> -->
			    
			  	<!-- </div> -->

			</div>

		</div>
    </div>
@endsection
