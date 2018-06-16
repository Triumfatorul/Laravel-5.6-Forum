@extends('layouts.app')

@section('content')
		<h1>Ban {{$user->name}}</h1>
		{!! Form::open(['action' => ['RankController@banUser', $user->id], 'method' => 'POST']) !!}
    		<div class="form-group">
                {{Form::text('reason', '', ['class' => 'form-control', 'placeholder' => 'Ban reason'])}}
            </div> 
            <div class="form-group">
                {{Form::text('time', '', ['class' => 'form-control', 'placeholder' => 'Ban time'])}}
            </div> 
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Ban', ['class' => 'btn btn-danger'])}}
		{!! Form::close() !!}
@endsection