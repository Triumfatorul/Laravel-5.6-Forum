@extends('layouts.app')
@section('content')
				<a href="/Categories" class="margin">Back</a><br>
				<a class="margin" href="/Forum/create">Create a new forum</a>
				<div class="posts">
					@foreach($forums as $forum)
						<div class="post margin">
							<span><a href="/Forum/{{$forum->name}}">{{$forum->name}}</a></span>
							<div class="info">
								<small>Posts:  {{$forum->posts}}</small>
								<small>Fallowers:  {{$forum->followers}}</small>
								<small>Members:  {{$forum->members}}</small>
							</div>
						</div>
					@endforeach
				</div>	
					
@endsection