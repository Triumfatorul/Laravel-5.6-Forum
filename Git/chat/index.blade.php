@extends('layouts.app')

@section('content')
	<div class="generalContent margin">
		<span>Chat rooms</span><br>	
			@if(count($conversations) > 0)
				@foreach($conversations as $user)
					<div class="well">
						@if($user->reciver_id != auth()->user()->name)
							<h3><a href="Chat/{{$user->reciver_id}}">{{$user->reciver_id}}</a></h3>
						@else
							<h3><a href="Chat/{{$user->sender_id}}">{{$user->sender_id}}</a></h3>
						@endif
					</div>
				@endforeach
			@else
				<p>You have no conversation found. Start one now!</p>
			@endif

	  {{$conversations->links()}}
	</div>
@endsection