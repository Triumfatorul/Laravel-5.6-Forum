@extends('layouts.app')

@section('content')
		<h1>Create post</h1>
		{!! Form::open(['action' => 'PostController@store', 'method' => 'POST']) !!}
    		<div class="form-group">
    			{{Form::label('title', 'Title')}}
    			{{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
    		</div> 
			<div class="form-group">
    			{{Form::label('content', 'Content')}}
    			{{Form::textarea('content', '', [ 'class' => 'form-control', 'placeholder' => 'Content'])}}
    		</div> 
            <div class="form-group">
            <select name="category" class="form-control">
                @foreach($categories as $category)
                        <option>{{$category->name}}</option>
                @endforeach
            </select>
            </div>
            <br>
			{{Form::submit('submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
@endsection