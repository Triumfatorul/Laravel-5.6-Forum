@extends('layouts.app')

@section('content')
	<div class="generalContent margin">
			<span>Add category</span>
		{!! Form::open(['action' => 'CategoryController@store', 'method' => 'POST']) !!}
    		<div class="form-group">
    			{{Form::label('title', 'Category name')}}
    			{{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Category name'])}}
    		</div> 
    		<label>
    			Permission:
    		</label> <br>
    		<label>All:</label> <input type="radio" name="permission" value="All"><br>
    		<label>Moderator 1:</label> <input type="radio" name="permission" value="Moderator 1"><br>
    		<label>Moderator 2:</label> <input type="radio" name="permission" value="Moderator 2"><br>
    		<label>Admin 1:</label> <input type="radio" name="permission" value="Admin 1"><br>
    		<label>Admin 2:</label> <input type="radio" name="permission" value="Admin 2"><br>
    		<label>Admin 3:</label> <input type="radio" name="permission" value="Admin 3"><br>
			{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
	</div>	
@endsection