@extends('layouts.app')
@section('content')
				<div class="posts">
					@foreach($forums as $forum)
						<div class="post margin">
							<span><a href="/Forum/{{$forum->name}}">{{$forum->name}}</a></span>
						</div>
					@endforeach
				</div>
					
@endsection