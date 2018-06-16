@extends('layouts.app')

<style type="text/css">
	.mainContent {
		margin-left: 35;
	}
</style>

@section('content')
	<a href="../home" class="btn btn-default">Back</a><br>
	<div class="mainContent">
	
	<h2>{{$data[0]->name}}'s profile</h2>

	<table class="table table-striped">
		<tr>
			<td>Username:</td>
			<td>{{$data[0]->name}}</td>
		</tr>
		<tr>
			<td>Rank:</td>
			<td>{{$data[0]->user_rank}}</td>
		</tr>
		@if(Auth()->user()->user_rank == 'Admin 2' || Auth()->user()->user_rank == 'Admin 3' || Auth()->user()->name == $data[0]->name)
		<tr>
			<td>Email:</td>
			<td>{{$data[0]->email}}</td>
		</tr>

		<tr>
			<td>Banned:</td>
			@if($data[0]->banned)
			<td>Yes( expire on: {{$data[1]->expire_on}} )</td>
			@else
			<td>No</td>
			@endif
		</tr>
	@endif
	</table>

	@if(Auth()->user()->user_rank == 'Admin 2' || Auth()->user()->user_rank == 'Admin 3' && Auth()->user()->name !=  $data[0]->name)
		<a href="{{$data[0]->id}}/edit" class="btn btn-default">Change rank</a> <br>
		@if(!$data[0]->banned)
			<a href="{{$data[0]->id}}/ban" class="btn btn-danger">Ban</a>
		@endif
	@endif
	
	</div>
@endsection