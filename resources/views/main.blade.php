@extends('layouts.app')

@section('content')

    <div style="padding-left: 250px">
        @foreach($rooms as $room)
            <p><a href="{{url('/room',$room->id)}}">{{$room->name}}</a></p>
        @endforeach
    </div>

@stop
