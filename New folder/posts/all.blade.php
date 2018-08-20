@extends('layouts.app')

@section('content')

			@if(count($posts) > 0)
				<a class="margin" href="/Posts/create/{{$posts[0]->forum}}">Add a new post</a>
				<div class="posts">
					@foreach($posts as $post)
						<div class="post margin">
							<span><a href="/Posts/{{$post->id}}">{{$post->title}}</a></span>
							<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
						</div>
					@endforeach
			@else
				<p>No post found</p>
			@endif

		  {{$posts->links()}}
		</div>
@endsection