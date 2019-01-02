@extends('layouts.default')

@section('content')
    <div class="py-4 container">
        <div class="row justify-content-center">
            @foreach($books as $book)
                @php
                    $image = asset($book->media[0]->getUrl());
                @endphp
                <book-card :book="{{$book}}" image="{{$image}}"></book-card>
            @endforeach
        </div>
    </div>
@endsection
