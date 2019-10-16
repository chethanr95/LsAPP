@extends('layouts.app')

@section('body')

    @guest
        <h3><font color="indigo">Hello Guest </font></h3>
    @else
        <h3><font color="indigo">Hi {{Auth()->user()->name}}</font></h3>
    @endguest

    <div class="jumbotron text-center">
       <h1>{{$title}}</h1>
       <p>This is the Laravel Project from Chethan, Happy Learning! :)</p>
       
       @guest
       <p> <a class="btn btn-primary btn-lg" href="/login" class="button">Login</a> 
           <a class="btn btn-success btn-lg" href="/register" class="button">Register</a> 
       </p>
       @endguest

       <p>
           <br>
           <a class="btn btn-info btn-lg" href="/posts">Go to Blog wall ></a>
       </p>
    </div>   
@endsection