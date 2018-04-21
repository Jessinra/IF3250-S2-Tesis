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
    <div class="container"> 
      	<h2>Dashboard</h2>

	  	<br>
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
			  		<div class="col-sm-5">
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

					<div class="col-sm-7">
						<h2>Jadwal Dosen</h2>
                        <a class="btn btn-outline-dark" href="/hasilbimbingan" role="button">Lihat Seluruh Jadwal Bimbingan</a>
					  	<!-- <?php if($state == 1) : ?>
						    <a href="#">This will only display if $condition is true</a>
						<?php else : ?>
						    even more html
						<?php endif; ?> -->

						<!-- <script>

							if(statejs==1){
							   $('body').append('<h1>There is user</h1>')
							} else{
							   $('body').append('<button>Login</button>')
							}
						</script> -->

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
@endsection
