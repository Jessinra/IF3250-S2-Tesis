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
						    		<div class="card">
						      			<div class="card-header">
						        			<a class="card-link" data-toggle="collapse" href="#collapseOne">
						          				Mahasiswa Bimbingan
						        			</a>
						      			</div>
						      			<div id="collapseOne" class="collapse show" data-parent="#accordion">
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
												{{--<div class="row justify-content-center">--}}
									                {{--<table class="mahasiswa-control-table">--}}
									                    {{--<tr class="text-center">--}}
									                        {{--<th>--}}
									                            {{--No--}}
									                        {{--</th>--}}
									                        {{--<th>--}}
									                            {{--Nama--}}
									                        {{--</th>--}}
									                        {{--<th>--}}
									                            {{--NIM--}}
									                        {{--</th>--}}
									                        {{--<th>--}}
									                            {{--Status--}}
									                        {{--</th>--}}
									                    {{--</tr>--}}
									                {{--@foreach($mahasiswauji as $item)--}}
									                    {{--@php($user = $item->user())--}}
									                    {{--<tr class="text-center">--}}
									                    {{--<td>--}}
									                        {{--{{$loop->iteration}}--}}
									                    {{--</td>--}}
									                        {{--<td>--}}
									                            {{--{{$user->name}}--}}
									                        {{--</td>--}}
									                        {{--<td>--}}
									                            {{--{{$user->username}}--}}
									                        {{--</td>--}}
									                        {{--<td>--}}
									                            {{--{{$item->getStatusString()}}--}}
									                        {{--</td>--}}
									                    {{--</tr>--}}
									                {{--@endforeach--}}
									                {{--</table>--}}
									            {{--</div>--}}
						        			</div>
								      	</div>
								    </div>
						  		</div>

					  		<!-- </div> -->

					<!-- </div> -->
			    <!-- </div> -->
			    
			  	<!-- </div> -->
			
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
		        		@if($item->getHasilBimbingan()->count() > 0)
				            @php($user = $item->user())
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
						@if($item->tesis()->seminarTesis())
						@if(!is_null($item->tesis()->seminarTesis()->hari))
							@php($user = $item->user())
				        	@php($seminar = $item->tesis()->seminarTesis())
				        	@php($date = $seminar->hari)
				        	@php($time = $seminar->waktu)
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
						        				<h5><span class="badge badge-success">Seminar Tesis</span></h5>
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
			        @endforeach
					@foreach($dosen->upcomingSidangAsPenguji1 as $st)
						@if($st->tanggal.'T'.$st->waktu >= $currenttime)
							<div class="row">
								<div class="col-md-4 text-center" style="border-right: 1px solid grey">
									<i class="fa fa-calendar-check-o mb-2" style="font-size:60px"></i>
									<div>{{date("d M Y", strtotime($st->tanggal.'T'.$st->jam.'UTC'))}}</div>
								</div>
								<div class="col">
									<div class="row mb-4">
										<div class="col">
											<h5><span class="badge badge-warning text-color-white">Sidang Tesis</span></h5>
											<h4>{{$user->name}} - {{$user->username}}</h4>
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
						@if($st->tanggal.'T'.$st->waktu >= $currenttime)
							<div class="row">
								<div class="col-md-4 text-center" style="border-right: 1px solid grey">
									<i class="fa fa-calendar-check-o mb-2" style="font-size:60px"></i>
									<div>{{date("d M Y", strtotime($st->tanggal.'T'.$st->jam.'UTC'))}}</div>
								</div>
								<div class="col">
									<div class="row mb-4">
										<div class="col">
											<h5><span class="badge badge-warning text-color-white">Sidang Tesis</span></h5>
											<h4>{{$user->name}} - {{$user->username}}</h4>
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
    </div>
@endsection
