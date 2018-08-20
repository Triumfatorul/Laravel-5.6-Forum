@extends('layouts.app')

@section('content')
	<div class="friends margin">
			<span class="title">Suspended Posts</span>
		
			@if(count($posts) > 0)
						@foreach($posts as $post)
							<div class="friend">
								<p><a href="../Posts/{{$post->category}}/{{$post->id}}">{{$post->title}}</a></p>
								<p><a href="../AdminPanel/approve/{{$post->id}}" class="btn btn-success">Approve</a></p>
								<p><a href="../AdminPanel/reject/{{$post->id}}" class="btn btn-danger">Reject</a></p>
							</div>	
						@endforeach
			@else
				<p>No post found</p>
			@endif

	  {{$posts->links()}}
	</div>		
@endsection