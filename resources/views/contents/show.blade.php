@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <ol>
                    @foreach ($regions as $region)
                        <div class="col p-4">
                            <h5>
                                <li>
                                    {{ $region->name }}
                                    <span class="float-end">
                                        <a class="btn btn-primary rounded-pill" href="#" role="button">View all</a>
                                    </span>
                                </li>
                            </h5>
                        </div>
                        <div class="row row-cols-1 row-cols-md-4 rounded m-2 p-2">

                            @foreach ($landmarks as $landmark)
                                <div class="row">
                                    <div class="col shadow rounded m-3">

                                        <div class="card h-100 border-light">
                                            <img src="{{ asset($landmark->photo) }}" class="card-img"
                                                alt="{{ $landmark->photo }}" height="150" width="150">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $landmark->name }}</h5>
                                                {{-- <p class="card-text">{{ $landmark->name }}</p> --}}
                                                <hr>
                                                <a class="icon-link icon-link-hover"
                                                    style="--bs-link-hover-color-rgb: 25, 135, 84;" href="#">
                                                    View more
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-arrow-right-circle"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                                        <use xlink:href="#arrow-right"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
@endsection
