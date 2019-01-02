@extends('layouts.default')

@section('content')
    <book :book="{{$book}}" image="{{$image}}" :user="{{$user}}" current-user="{{$currentUser}}"></book>
@endsection
