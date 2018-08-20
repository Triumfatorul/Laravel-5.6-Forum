@extends('layouts.app')

@section('content')
	<div class="generalContent margin">
		<span class="title">Set rank</span>
		{!! Form::open(['action' => ['RankController@update', $data[0]->id], 'method' => 'POST']) !!}
    		<div class="form-group">
                <select name="rank" class="form-control">
                	@foreach($data[1] as $rank)
                		<option>{{$rank->name}}</option>
                	@endforeach
                </select>
            </div>  
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('submit', ['class' => 'btn btn-primary center'])}}
		{!! Form::close() !!}
	</div>
		
@endsection