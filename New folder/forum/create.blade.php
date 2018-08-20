@extends('layouts.app')

@section('content')
	<div class="generalContent margin">
		<span>Create a forum</span>
		{!! Form::open(['action' => 'ForumsController@store', 'method' => 'POST']) !!}
    		<div class="form-group">
    			{{Form::label('name', 'Forum name')}}
    			{{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Forum name'])}}
			</div> 
			<div class="form-group">
				{{Form::label('category', 'Category')}}
            <select name="category" class="form-control">
					@foreach($categories as $category)
							<option>{{$category->name}}</option>
					@endforeach
				</select>
            </div>
			{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
	</div>	
@endsection