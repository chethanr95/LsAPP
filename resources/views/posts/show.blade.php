@extends('layouts.app')

@section('body')

    <a href="/posts" class="btn">&lt Go Back</a>

    <h1>{{$post->title}}</h1>
    
    <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100" alt="No Image Available">
    <br><br>

    <div>
        {!!$post->body!!}
    </div>
    <hr>
<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>

    {{--@if(! @guest)--}}
    @if(! Auth::guest())
        @if(auth()->user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
            
            {{Form::open(['action' => ["postsController@destroy", $post->id], 'method' => "POST", 'class' => 'float-right']) }}
                {{Form::hidden('_method', "DELETE")}}
                {{Form::submit('Delete', ['class' => "btn btn-danger"])}}
            {{Form::close()}}
        @endif    
    @endif
@endsection