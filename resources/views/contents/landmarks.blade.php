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

    <div class="row">

        <div class="col-2 text-center">
            <div class="position-fixed m-2 p-1">
                @if (is_null($guides))
                    <a class="btn btn-outline-success" href="{{ route('orders.index') }}">
                        <img src="/images/navbar_icons/request-guide.png" class="rounded" alt="contact_us" width="22"
                            height="22" !important>
                        {{ __('Request Tour Guide') }}
                    </a>
                @else
                    @if ($guides->count() > 0)
                        <h5>{{ __('Request Tour Guide') }}</h5>
                        @foreach ($guides as $guide)
                            <a href="{{ route('orders.tourist', $guide->user_id) }}"
                                class="link-success link-offset-2 link-underline link-underline-opacity-0">
                                <div class="row rounded-2 m-2 p-1 border border-2 border-secondary">
                                    <div class="col-3">
                                        <img src="{{ $guide->photo }}" class="rounded-circle"
                                            alt="{{ $guide->user->name }}" width="50" height="50">
                                    </div>
                                    <div class="col-9">
                                        <h6 class="fs-6">{{ $guide->user->name }}</h6>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                    <h5>Not found any available guides !</h5>
                    @endif
                @endif
            </div>
        </div>

        <div class="col-10">
            <div class="container p-3">
                @if ($landmarks->count() > 0)
                    <div class="row">
                        <div class="col m-3">

                            @foreach ($landmarks as $landmark)
                                <div class="col p-4">
                                    <h5>
                                        {{ ($landmarks->currentPage() - 1) * $landmarks->perPage() + $loop->iteration }} .
                                        {{ $landmark->name }}
                                        @if ($landmark->activities->count() > 4)
                                            <span class="float-end">
                                                <a class="btn btn-primary rounded-pill" href="#" role="button">View
                                                    all</a>
                                            </span>
                                        @endif
                                    </h5>
                                </div>
                                <div class="row row-cols-1 row-cols-md-1 rounded m-2 p-2">


                                    <div class="card h-100 border-light">
                                        <div class="row row-cols-1 row-cols-md-4 shadow rounded m-3">
                                            @foreach ($landmark->activities->take(4) as $activity)
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        {{ $loop->index + 1 }} .
                                                        {{ $activity->description }}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                            <div class="pagination justify-content-center">
                                {{ $landmarks->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <h1 class="text-center">Not found any activities</h1>
                @endif
            </div>
        </div>
    </div>
@endsection
