

@extends('layouts.app')

<style type="text/css">
	 #suspend {
		margin-left: 852px;
	}
</style>

@section('content')
	<a href="/Forum/{{$data[0]->forum}}" class="margin">Back</a>
	@if(Auth()->user()->user_rank != 'Member' && Auth()->user()->id != $data[0]->user_id)
		 <a href="{{$data[0]->id}}/edit" class="btn btn-danger" id="suspend">Suspend</a>
	@endif
	<div class="mainContent margin">
		<span>{{$data[0]->title}}</span>	
		<br />
		<div class="body">
			<p><?php  echo nl2br($data[0]->body) ?></p>
			<br />
			<small>Written on {{$data[0]->created_at}} by {{$data[0]->user->name}}</small>
			@if($data[0]->user->name ==  auth()->user()->name)
						<br />
		
							<a href="/Posts/{{$data[0]->id}}/edit" class="btn btn-primary">Edit</a>
							{!!Form::open(['action' => ['PostController@destroy', $data[0]->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
												{{Form::hidden('_method', 'DELETE')}}
												{{Form::submit('Delete', ['class' => 'btn btn-danger', 'id' => 'delete'])}}
							{!!Form::close()!!}

			@endif 
		</div>
	</div>
	<hr>

	<a href="/Replies/create/{{$data[0]->id}}" class="margin">Reply</a>

	<div class="replies">
		@if(count($data[1]) > 0)
			@foreach($data[1] as $reply)
				<div class="reply margin">
					<div class="body">
						<p><?php  echo nl2br($reply->body) ?></p>
						<small>Written on {{$reply->created_at}} by {{$reply->user->name}}</small>
						
						@if($reply->user->name ==  auth()->user()->name)
							<br>
							<div class="tools">
							<a href="/Replies/{{$reply->id}}/edit" class="btn btn-primary">Edit</a>
							{!!Form::open(['action' => ['RepliesController@destroy', $reply->id], 'method' => 'POST', 'class' => 'pull-right'])!!}												{{Form::hidden('_method', 'DELETE')}}
								{{Form::submit('Delete', ['class' => 'btn btn-danger', 'id' => 'delete'])}}
							{!!Form::close()!!}
							</div>
								
						@endif		
					</div>
				
					
			</div> 
			@endforeach	
		@else 
			<div class="no-rep margin">
				<span>No replies. Be first which post a reply.</span>
			</div>	
		@endif

		{{ $data[1]->links() }}
	</div>
	
@endsection

