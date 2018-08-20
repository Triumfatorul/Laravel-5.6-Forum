@extends('layouts.app')

<style type="text/css">

</style>

@section('content')
	<div class="generalContent margin">
		<span>Chat room</span>

		@if(count($data[0]) > 0)
				@foreach($data[0] as $msg)
						@if($msg->reciver_id != auth()->user()->name)
							<div class="sent-message">
								<p>{{$msg->content}}</p>
							</div>
						@else
							<div class="recived-message">
								<p>{{$msg->content}}</p>
							</div>
						@endif
				@endforeach
			@else
				<p>You have no messages with this user. Send a message now!</p>
			@endif

	  {{$data[0]->links()}}	


		<hr>	
		{!! Form::open(['action' => 'ChatController@store', 'method' => 'POST']) !!}
    		<div class="form-group">
    			{{Form::text('content', '', ['class' => 'form-control width', 'placeholder' => 'Insert message'])}}
    			{{Form::hidden('sender', $data[1], ['class' => 'form-control'])}}
				{{Form::submit('submit', ['class' => 'btn btn-primary'])}}
			</div> 
		{!! Form::close() !!}
	</div>			
@endsection