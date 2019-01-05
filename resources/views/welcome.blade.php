@extends('layouts.welcome')

@section('content')
    <header>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <a href="" class="navbar-brand d-flex align-items-center">
                    <i class="fa fa-book" style="margin-right: 4px;"></i>
                    <strong>Book store</strong>
                </a>
                <div>
                    <a href="/cart">
                        <button type="button" class="btn btn-outline-light">
                            <i class="fas fa-shopping-cart"></i> (<span id="cartCounter">0</span>)
                        </button>
                    </a>
                    @auth
                        <a href="{{ route('home') }}">
                            <button type="button" class="btn btn-outline-light">
                                Profile
                            </button>
                        </a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            <button type="button" class="btn btn-outline-light">
                                Logout
                            </button>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('register') }}">
                            <button type="button" class="btn btn-outline-light">
                                Register
                            </button>
                        </a>
                        <a href="{{ route('login') }}">
                            <button type="button" class="btn btn-outline-light">
                                Login
                            </button>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Book store "Kod Benje"</h1>
                <p class="lead text-muted">Browse our book collection and find something to buy, or even post the one you are selling. Buy it using our secure online payment system. Happy reading!</p>
                <p>
                    <a href="/book/create" class="btn btn-primary my-2">Have a book to sell?</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                    @foreach($books as $book)
                        @php
                            $url = env('APP_URL') . $book->getMedia('book-images')[0]->getUrl();
                            $date = \Carbon\Carbon::parse($book->created_at);
                            $now = \Carbon\Carbon::now();

                            $diff = $date->diffForHumans($now);
                        @endphp

                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top img-thumbnail" src="{{ $url }}" alt="Card image cap" style="width: 100%; height: 30vh">
                                <div class="card-body">
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ '/book/' . $book->id }}">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                            </a>
                                        </div>
                                        <small class="text-muted">{{ $diff }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </main>

    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#" id="scroll">Back to top</a>
            </p>
            <p>Album example is &copy; Bootstrap, but I downloaded and customized it for myself as they allow it!</p>
            <p>New to Bootstrap? <a href="https://getbootstrap.com/">Visit the homepage</a> or read our <a href="https://getbootstrap.com/docs/getting-started">getting started guide</a>.</p>
        </div>
    </footer>
@endsection