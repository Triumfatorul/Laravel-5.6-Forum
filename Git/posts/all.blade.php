@extends('layouts.app')

@section('content')
			<a class="margin" href="/Categories/{{$category}}">Back</a><br>
			<a class="margin" href="/Posts/create/{{$forum}}">Add a new post</a>	
			@if(count($posts) > 0)
				
				<div class="posts">
					@foreach($posts as $post)
						<div class="post margin">
							<span><a href="/Posts/{{$post->id}}">{{$post->title}}</a></span>
							<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
						</div>
					@endforeach
			@else
				<p class="margin">No post found</p>
			@endif

		  {{$posts->links()}}
		</div>
@endsection