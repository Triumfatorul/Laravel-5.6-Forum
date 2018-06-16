@extends('layouts.app')

@section('content')
		<h1>Categories</h1>
				<h4><a class="btn btn-default" href="Posts/create">Add a new post</a></h4>
				<br>
				@foreach($posts as $post)
					<div class="well">
						<h3><a href="Posts/{{$post->name}}">{{$post->name}}</a></h3>
					</div>
				@endforeach
@endsection