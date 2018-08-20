@extends('layouts.app')


@section('content')

	<a href="../home" class="margin">Back</a><br>
	<div class="profile margin">
	
	<span>{{$data[0]->name}}'s profile</span>

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
			<td>Yes( expire on: {{$data[1][0]->expire_on}} )</td>
			@else
			<td>No</td>
			@endif
		</tr>
	@endif
	</table>

	@if(Auth()->user()->name != $data[0]->name)
	<div class="actions">
		<a href="/Chat/{{$data[0]->name}}" class="btn btn-primary">Send a message</a>	
		<a href="/Friends/store/{{$data[0]->id}}" class="btn btn-primary">Send friend request</a>
		@if(Auth()->user()->user_rank == 'Admin 2' || Auth()->user()->user_rank == 'Admin 3' || Auth()->user()->user_rank == 'Admin 1')
			<a href="{{$data[0]->id}}/edit" class="btn btn-primary">Change rank</a> 
			@if(!$data[0]->banned )
				<a href="{{$data[0]->id}}/ban" class="btn btn-danger">Ban</a>
			@endif
		@endif
	</div>
	@endif
	</div>
@endsection