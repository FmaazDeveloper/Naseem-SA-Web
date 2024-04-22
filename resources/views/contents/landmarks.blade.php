@extends('layouts.app')

@section('content')

    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators" data-interval="1000">
            @if ($regions)
                @foreach ($regions as $region)
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
            @if ($regions)
                @foreach ($regions as $region)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <img src="{{ asset($region->card_photo) }}" class="{{ $loop->index }}-slide"
                            alt="{{ $region->card_photo }}" width="1700" height="500">
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1>{{ $region->name }}</h1>
                                {{-- <p class="opacity-75">Some representative placeholder content for the first slide of the
                                carousel.</p> --}}
                                <p><a class="btn btn-primary" href="{{ route('contents.landmarks', $region->id) }}">View
                                        more</a></p>
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
        @if ($activities->count() > 0)
            <div class="row">
                <div class="col m-3">

                    @foreach ($landmarks as $landmark)
                        <div class="col p-4">
                            <h5>
                                {{ ($landmarks->currentPage() - 1) * $landmarks->perPage() + $loop->iteration }} .
                                {{ $landmark->name }}
                                <span class="float-end">
                                    <a class="btn btn-primary rounded-pill" href="#" role="button">View all</a>
                                </span>
                            </h5>
                        </div>
                        <div class="row row-cols-1 row-cols-md-1 rounded m-2 p-2">


                            <div class="card h-100 border-light">
                                <div class="row row-cols-1 row-cols-md-4 shadow rounded m-3">
                                    @foreach ($activities as $activity)
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $activity->description }}</h5>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    @endforeach
                    <div class="pagination justify-content-center">
                        {{ $landmarks->links() }}
                    </div>
                @else
                </div>
            </div>
            <h1 class="text-center">Not found any activities</h1>
        @endif
    </div>
@endsection
