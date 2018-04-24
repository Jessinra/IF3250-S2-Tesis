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
      	<h2>Dashboard</h2>

	  	<br>

	  	<div class="row">
			<div class="col col-md-6">
			  	<!-- Nav tabs -->
			  	<ul class="nav nav-tabs" role="tablist">
			    	<li class="nav-item">
			      		<a class="nav-link active" data-toggle="tab" href="#home">Daftar Mahasiswa</a>
			    	</li>
			    	<li class="nav-item">
			      		<a class="nav-link" data-toggle="tab" href="#menu1">Input Nilai Dosen Tesis</a>
			    	</li>
			    	<!-- <li class="nav-item">
			      		<a class="nav-link" data-toggle="tab" href="#menu2">Input Nilai</a>
			    	</li> -->
			  	</ul>

	  			<!-- Tab panes -->
	  	
			  	<div class="tab-content">
			    	<div id="home" class="container tab-pane active"><br>
			      		<div class="row">
					  		<div class="col">
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
						        				<p>tes</p>
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

						  			<div class="card">
									    <div class="card-header">
									        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
									        	Mahasiswa Kelas Tesis
									    	</a>
									    </div>
						      			<div id="collapseThree" class="collapse" data-parent="#accordion">
						        			<div class="card-body">
						        				<p>tes</p>
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

					  		</div>

					</div>
			    </div>

			    <div id="menu1" class="container tab-pane fade"><br>
			      	<h3>Input nilai Dosen Tesis</h3>
			    </div>

			    <!-- <div id="menu2" class="container tab-pane fade"><br>
			      	<h3>Input Nilai</h3>
			      	<p>Input nilai sidang tesis.</p>
			    </div> -->
			    
			  	</div>
			</div>
			<div class="col col-md-6">
				<!-- <h2>Jadwal Dosen</h2> -->
				<a class="btn btn-outline-dark" href="/hasilbimbingan" role="button">Lihat Seluruh Jadwal Bimbingan</a>
				
				<!-- <h3>Jadwal</h3>
		        <hr/> -->
		        
		        <div class="mt-5">
		        	@php($currenttime = \Carbon\Carbon::now()->toDateString())
		        	@foreach($mahasiswabimbingan as $item)
		        		@if($item->getHasilBimbingan()->count() > 0)
				            @php($user = $item->user())
				            @php($jadwalbimbingan = \Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$item->gethasilBimbingan()[0]->waktu_bimbingan_selanjutnya))
				            @if($jadwalbimbingan >= $currenttime)
						        <div class="row">
						        	<div class="col-md-auto text-center" style="border-right: 1px solid grey">
						        		<i class="fa fa-calendar-check-o mb-2" style="font-size:60px"></i>
						        		<div>{{$jadwalbimbingan->format('d F Y')}}</div>
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
						@if(!is_null($item->tesis()->seminarTesis()->hari))
							@php($user = $item->user())
				        	@php($seminar = $item->tesis()->seminarTesis())
				        	@php($date = $seminar->hari)
				        	@php($time = $seminar->waktu)
				        	@php($datetimeString = $date." ".$time)
				        	@php($jadwalseminar = \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $datetimeString))
				        	@if($jadwalseminar >= $currenttime)
				        		<div class="row">
						        	<div class="col-md-auto text-center" style="border-right: 1px solid grey">
						        		<i class="fa fa-calendar-check-o mb-2" style="font-size:60px"></i>
						        		<div>{{$jadwalseminar->format('d F Y')}}</div>
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
			        @endforeach
		        </div>
		        
			</div>
		</div>
    </div>
@endsection
