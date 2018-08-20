@extends('layouts.app')


@section('content')
	<div class="generalContent margin">
		<span>Admin Panel</span><br>
		<a href="AdminPanel/suspended">Suspended posts</a> 
		<a href="Category/create">Create a new category</a> 
		@if(App\User::find(Auth()->user()->id)->rank->Admin_Panel_3)
			<a href="/Rank/create">Create new rank</a>
		@endif
	</div>
			
@endsection