@extends('layouts.app')

@section('content')
		<h1>Suspended Posts</h1>
			@if(count($posts) > 0)
				<div class="well">
				<table>
					@foreach($posts as $post)
					  	<tr>
					       <td><h3><a href="../Posts/{{$post->id}}">{{$post->title}}</a></h3></td>
					       <td><h3><a href="../AdminPanel/approve/{{$post->id}}" class="btn btn-success">Approve</a></h3></td>
					       <td><h3><a href="../AdminPanel/reject/{{$post->id}}" class="btn btn-danger">Reject</a></h3></td>
					    </tr>
					@endforeach
				</table>
				</div>
			@else
				<p>No post found</p>
			@endif

	  {{$posts->links()}}
@endsection