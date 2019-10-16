@extends('layouts.app')

@section('body')
    <h3>Posts</h3><small> posted from all users</small>
    @if(count($posts) > 0)
    <hr>
        @foreach($posts as $post)
            <div class="well">
                <div class="row">    
                    <div class="col-md-4 col-sm-4">
                        <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <a href=/posts/{{$post->id}}>{{$post->title}}</a>
                        <br><small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                    </div>
                </div>    
            </div>
            <hr>
        @endforeach
        
    @else
        <small>NO POSTS</small>
    @endif
@endsection