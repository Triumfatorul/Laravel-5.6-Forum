@extends('layouts.app')

<style type="text/css">
	.bg-success {
		margin-left: 150px;
		width: 300px;
	}

</style>

@section('content')
		<h1>Chat room</h1>

		@if(count($data[0]) > 0)
				@foreach($data[0] as $msg)
					<div class="well">
						@if($msg->reciver_id != auth()->user()->name)
							<h3 class="bg-success">{{$msg->content}}</h3>
						@else
							<h3>{{$msg->content}}</a></h3>
						@endif
					</div>
				@endforeach
			@else
				<p>You have no messages with this user. Send a message now!</p>
			@endif

	  {{$data[0]->links()}}	


		<hr><br><br>
		{!! Form::open(['action' => 'ChatController@store', 'method' => 'POST']) !!}
    		<div class="form-group">
    			{{Form::text('content', '', ['class' => 'form-control', 'placeholder' => 'Insert message'])}}
    			{{Form::hidden('sender', $data[1], ['class' => 'form-control'])}}
    		</div> 
			{{Form::submit('submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
@endsection