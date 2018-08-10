@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    @if(count($devices) > 0)
        <ul class="list-group">
        @foreach($devices as $device)
                <li class="list-group-item">{{$device}}</li>
        @endforeach
        </ul>
    @endif
@endsection