@extends('layouts.app')

@section('content')
	<div class="friends margin">
		<span class="title">Your friends</span>
			@if(count($friends) > 0)
					@foreach($friends as $friend)
						@if($friend->accepted)
							<div class="friend">
								@if($friend->sentBy != Auth()->user()->id)
									<p><a href="/Rank/{{$friend->sentBy}}">{{$friend->user_1->name}}</a></p>
								@else
									<p><a href="/Rank/{{$friend->sentTo}}">{{$friend->user_2->name}}</a></p>
								@endif
			{!!Form::open(['action' => ['FriendsController@destroy', $friend->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
	        {{Form::hidden('_method', 'DELETE')}}
	        {{Form::submit('Unfriend', ['class' => 'btn btn-danger'])}}
	        {!!Form::close()!!}
							</div>
						@else
							<div class="friend">
								@if($friend->sentBy != Auth()->user()->id)
									<p><a href="/Rank/{{$friend->sentBy}}">{{$friend->user_1->name}}</a></p>

			{!! Form::open(['action' => ['FriendsController@update', $friend->id], 'method' => 'POST']) !!}		
	        {{Form::hidden('_method', 'PUT')}} 
			{{Form::submit('Accept', ['class' => 'btn btn-primary'])}}
			{!! Form::close() !!}


			{!!Form::open(['action' => ['FriendsController@destroy', $friend->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
	        {{Form::hidden('_method', 'DELETE')}}
	        {{Form::submit('Reject', ['class' => 'btn btn-danger'])}}
	        {!!Form::close()!!}


								@else
									<p><a href="/Rank/{{$friend->sentTo}}">{{$friend->user_2->name}}</a></p><span class="pending">In pending...</span>
									
								@endif
							</div>
						@endif
					@endforeach
			@else
				<p>You don't have any friend...</p>
			@endif
	</div>
@endsection