@extends('layouts.app')

@section('body')
    <h3>Create Post</h3>

    {{Form::open(['action' => 'postsController@store', 'method' => 'post', 'enctype' => 'multipart/form-data'])}}
        <div class="form-group">
            {{Form::label('title','Title')}}        
            {{Form::text('title', '',['class' => "form-control", 'placeholder' => 'title here'])}}
        </div>
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => "form-control", 'placeholder' => 'body here'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
    {{Form::close()}}

@endsection 