@extends('layouts.app')

@section('content')
		<h1>Add rank</h1>
		{!! Form::open(['action' => ['RankController@update', $data[0]->id], 'method' => 'POST']) !!}
    		<div class="form-group">
                <select name="rank">
                	@foreach($data[1] as $rank)
                		<option>{{$rank->name}}</option>
                	@endforeach
                </select>
            </div>  
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
@endsection