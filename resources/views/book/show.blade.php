@extends('layouts.default')

@section('content')
    <book :book="{{$book}}" image="{{$image}}"></book>
@endsection
