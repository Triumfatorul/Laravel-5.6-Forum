@extends('layouts.app')

@section('content')
	<div class="form margin">
		{!! Form::open(['action' => 'PostController@store', 'method' => 'POST']) !!}
    		<div class="form-group">
    			{{Form::label('title', 'Title', ['class' => 'ext-basic-format'])}}
    			{{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
    		</div> 
			<div class="form-group">
    			{{Form::label('content', 'Content')}}
    			{{Form::textarea('content', '', [ 'class' => 'form-control', 'placeholder' => 'Content'])}}
    		</div> 
			<br>	 
			<input type="hidden" value={{$forum}} name="forum">
			{{Form::submit('submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
	</div>
@endsection