@extends('layouts.app')

@section('body')
<h1>{{$title}}</h1>
    <p>This is the Services page : lsapp.me/services</p>

    @if(count($skills) > 0)
        <ul class="list-group">
            @foreach($skills as $skill)
                <li class="list-group-item">
                    {{$skill}}
                </li>
            @endforeach
        </ul>
    @endif    



@endsection
