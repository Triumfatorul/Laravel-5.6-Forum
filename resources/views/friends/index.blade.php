@extends('layouts.app')

@section('content')
		<h1>Your friends</h1>
				@foreach($friends as $friend)
					@if($friend->accepted)
						<div class="well">
							@if($friend->sentBy != Auth()->user()->id)
								<h3><a href="../Rank/{{$friend->sentBy}}">{{$friend->sentBy}}</a></h3>
							@else
								<h3><a href="../Rank/{{$friend->sentTo}}">{{$friend->sentTo}}</a></h3>
							@endif
						</div>
					@endif
				@endforeach
@endsection