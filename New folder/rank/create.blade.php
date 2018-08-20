@extends('layouts.app')

@section('content')
        <div class="generalContent margin">
                <span>Create a rank</span>
		{!! Form::open(['action' => 'RankController@store', 'method' => 'POST']) !!}
    		<div class="form-group">
    			{{Form::label('name', 'Rank name')}}
    			{{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Rank name'])}}
    		</div> 
			<div class="form-group">
    			{{Form::label('description', 'Description')}}
    			{{Form::textarea('description', '', [ 'class' => 'form-control', 'placeholder' => 'Rank description'])}}
    		</div> 
            <div class="form-group">
            {{Form::label('', 'Moderator Panel 1')}}
            <br>
            <select name="Moderator_Panel_1" class="form-control">
                    <option>false</option>
                    <option>true</option>
            </select>
            </div>
            
            <br>
            
             <div class="form-group">
            {{Form::label('', 'Moderator Panel 2')}}
            <br>
            <select name="Moderator_Panel_2" class="form-control">
                    <option>false</option>
                    <option>true</option>
            </select>
            </div>
            
            <br>
            

             <div class="form-group">
            {{Form::label('', 'Admin Panel 1')}}
            <br>
            <select name="Admin_Panel_1" class="form-control">
                    <option>false</option>
                    <option>true</option>
            </select>
            </div>
           
            <br>

             <div class="form-group">
            {{Form::label('', 'Admin Panel 2')}}
            <br>
            <select name="Admin_Panel_2" class="form-control">
                    <option>false</option>
                    <option>true</option>
            </select>
            </div>
           
            <br>
           
             <div class="form-group">
            {{Form::label('','Admin Panel 3')}}
            <br>
            <select name="Admin_Panel_3" class="form-control">
                    <option>false</option>
                    <option>true</option>
            </select>
            </div>
           
            <br>
           

			{{Form::submit('submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
        </div>
@endsection