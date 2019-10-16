@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="text text-left">
        <font color="indigo"><h5>Hi {{auth()->user()->name}}</h5></font> 
        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        <i><font color="indigo" size=1p>Last updated on {{auth()->user()->updated_at}} </font></i>
        </h5>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" >
                    <font color="blue" size=4p>Dashboard</font>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/posts/create" class="btn btn-primary">Create Post</a> 
                    <hr>                 
                    <h5><font color="green">Your Blog Posts</font></h5>
                    
                    <table class="table table-default table-hover table-condensed"> 
                        @if(count($posts) > 0)
                            @foreach($posts as $post)
                                <tr>
                                <td> <a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                                    <td> 
                                        <a href="/posts/{{$post->id}}/edit" class="btn btn-success btn-sm">Edit</a>                                    
                                    </td>
                                    <td> 
                                        {{Form::open(['action' => ["postsController@destroy", $post->id], 'method' => 'POST' ])}}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete',['class' => "btn btn-danger btn-sm"])}}
                                        {{Form::close()}}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            No Posts
                        @endif    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
