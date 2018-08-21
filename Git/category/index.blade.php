@extends('layouts.app')
@section('content')
				<a class="margin" href="/Forum/create">Create a new forum</a>
				<div class="posts">
					@foreach($categories as $category)
						<div class="post margin">
							<span><a href="Categories/{{$category->name}}">{{$category->name}}</a></span>
						</div>
					@endforeach
				</div>
					
@endsection