@extends('layouts.app')

@section('content')
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators" data-interval="1000">
            @if ($administrative_regions)
                @foreach ($administrative_regions as $administrative_region)
                    @if ($loop->first)
                        <a data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                            aria-label="Slide 1"></a>
                    @else
                        <a data-bs-target="#myCarousel" data-bs-slide-to="{{ $loop->index }}"
                            aria-label="Slide {{ $loop->index }}">
                        </a>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="carousel-inner">
            @if ($administrative_regions)
                @foreach ($administrative_regions as $administrative_region)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <img src="{{ asset($administrative_region->photo) }}" class="{{ $loop->index }}-slide"
                            alt="{{ $administrative_region->photo }}" width="1700" height="500">
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1>{{ $administrative_region->name }}</h1>
                                {{-- <p class="opacity-75">Some representative placeholder content for the first slide of the
                                    carousel.</p> --}}
                                <p><a class="btn btn-primary"
                                        href="{{ route('contents.regions', $administrative_region->id) }}">View more</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container p-3">
        @if ($landmarks->count() > 0)
            <div class="row">

                <div class="col m-3">

                    @foreach ($regions as $region)
                        <div class="col p-4">
                            <h5>
                                {{ ($regions->currentPage() - 1) * $regions->perPage() + $loop->iteration }} .

                                {{ $region->name }}
                                <span class="float-end">
                                    <a class="btn btn-primary rounded-pill"
                                        href="{{ route('contents.regions', $region->id) }}" role="button">View
                                        all</a>
                                </span>
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
                                                <hr>
                                                <a class="icon-link icon-link-hover"
                                                    style="--bs-link-hover-color-rgb: 25, 135, 84;"
                                                    href="{{ route('contents.landmarks', $region->id) }}">
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
                    <div class="pagination justify-content-center">
                        {{ $regions->links() }}
                    </div>
                @else
                </div>
            </div>
            <h1 class="text-center">Not found any landmark</h1>
        @endif
    </div>
@endsection
