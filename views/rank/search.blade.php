@extends('layouts.app')

@section('content')
	<div class="generalContent margin">
			<span>Search result</span>
		
			@if(count($users) > 0)
				@foreach($users as $user)
					<div class="well">
						<a href="/Rank/{{$user->id}}">{{$user->name}}</a>
					</div>
				@endforeach
			@else
				<p>No user found</p>
			@endif

		    {{$users->links()}}
	</div>
@endsection


		