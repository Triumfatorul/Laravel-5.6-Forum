@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Your posts</h2>
                    <h3 class="text-danger">Suspended post! Check them and edit it, else they can be deleted!</h3>
                    <table class="table table-striped">
                        <tr>
                            <td>Title</td>
                            <td></td>
                            <td></td>
                        </tr>

                    @foreach($posts as $post)
                       @if($post->suspended) 
                          <tr>
                                <td>{{$post->title}}</td>
                                <td><a href="../Posts/{{$post->category}}/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                <td>
                                    {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                          </tr>
                        @endif
                    @endforeach
                    </table>

                    <hr>


                    <h3>Normal post</h3>
                   <table class="table table-striped">
                        <tr>
                            <td>Title</td>
                            <td></td>
                            <td></td>
                        </tr>

                    @foreach($posts as $post)
                       @if(!$post->suspended) 
                          <tr>
                                <td>{{$post->title}}</td>
                          <td><a href="../Posts/{{$post->category}}/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                <td>
                                    {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                          </tr>
                        @endif
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
