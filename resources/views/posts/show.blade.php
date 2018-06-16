

@extends('layouts.app')

<style type="text/css">
	.well {
		margin-left: 65;
	}
	.mainContent {
		margin-left: 35;
	}
	.mainContent h1{
		text-align: center;
	}
	 #suspend {
		margin-left: 1100px;
	}
</style>

@section('content')
	<a href="../Posts" class="btn btn-default">Back</a>
	@if(Auth()->user()->user_rank != 'Member' && Auth()->user()->id != $data[0]->user_id)
		 <a href="{{$data[0]->id}}/edit" class="btn btn-danger" id="suspend">Suspend</a>
	@endif
	<div class="mainContent">
		<h1>{{$data[0]->title}}</h1>	
		<br /><br /><br />
		<h2>{{$data[0]->body}}</h2>
		<small>Written on {{$data[0]->created_at}} by {{$data[0]->user->name}}</small>
	</div>
	<hr>

	<div class="well">
		<a href="../../Replies/create/{{$data[0]->id}}">Reply</a>
	</div>

	@if(count($data[1]) > 0)
		@foreach($data[1] as $reply)
			<div class="well">
				<br />
				<h4>{{$reply->body}}</h4>
				<small>Written on {{$reply->created_at}} by {{$reply->user->name}}</small>
				@if($reply->user->name ==  auth()->user()->name)
					<br />
					<a href="../Replies/{{$reply->id}}/edit">Edit</a>
					 {!!Form::open(['action' => ['RepliesController@destroy', $reply->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                      {!!Form::close()!!}
				@endif 
			</div>
		@endforeach	
	@else 
		<h3>No replies. Be first which post a reply.</h3>
	@endif

	{{ $data[1]->links() }}
	
	
@endsection

