@extends('layouts.app')

@section('content')
		<h1>Posts</h1>
			@if(count($posts) > 0)
				@foreach($posts as $post)
					<div class="well">
						<h3><a href="{{$post->category}}/{{$post->id}}">{{$post->title}}</a></h3>
						<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
					</div>
				@endforeach
			@else
				<p>No post found</p>
			@endif

	  {{$posts->links()}}
@endsection