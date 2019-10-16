@extends('layouts.app')

@section('body')
    <h3>Edit Post</h3>

    {{Form::open(['action' => ['postsController@update', $post->id], 'method' => 'POST'])}}
        {{Form::hidden('_method', 'PUT')}}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'title here'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body, ['id' => "article-ckeditor", 'class' => "form-control", 'placeholder' => "body here"])}}
        </div>
        <div class="form-group">
                {{Form::file('cover_image')}}
                <p>Current_File : {{$post->cover_image}} </p>
        </div>    
        {{Form::submit('submit', ['class' =>"btn btn-primary"])}}
    {{Form::close()}}
@endsection