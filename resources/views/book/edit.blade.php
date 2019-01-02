@extends('layouts.default')

@section('content')
    <book-form :book="{{$book}}"></book-form>
@endsection
