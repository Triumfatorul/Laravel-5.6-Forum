@extends('layouts.app')


@section('content')
			
			<h1>Admin Panel</h1>
			<a href="AdminPanel/suspended">Suspended posts</a> <br>
			<a href="Category/create">Create a new category</a> <br>
			@if(Auth()->user()->user_rank == 'Admin 3')
				<a href="/Proiect/public/Rank/create">Create new rank</a>
			@endif
@endsection