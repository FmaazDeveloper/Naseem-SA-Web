@extends('layouts.app')

@section('content')
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
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
                            alt="{{ $administrative_region->photo }}" width="100%" height="500">
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1>{{ $administrative_region->name }}</h1>
                                <p>
                                    <a class="btn btn-primary" href="{{ route('contents.regions', $administrative_region->id) }}">View
                                        more</a>
                                </p>
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

    <div class="row mb-5">

        <div class="col-2">
            <div class="position-fixed m-2 p-1">
                @if (is_null($guides))
                    <a class="btn btn-outline-success" href="{{ route('request_orders.index') }}">
                        <img src="{{ asset('images/navbar_icons/request-guide.png') }}" class="rounded" alt="guide" width="22"
                            height="22" !important>
                        {{ __('Request Tour Guide') }}
                    </a>
                @else
                    @if ($guides->count() > 0)
                        <h5>{{ __('Request Tour Guide') }}</h5>
                        @foreach ($guides as $guide)
                            <a href="{{ route('request_orders.create', $guide->user_id) }}"
                                class="link-success link-offset-2 link-underline link-underline-opacity-0">
                                <div class="row rounded-2 m-2 p-1 border-2 border-secondary">
                                    <div class="col-3">
                                        <img src="{{ asset($guide->photo ?? 'images/profile_icons/profile_image.png') }}"
                                            class="rounded-circle" width="50" height="50">
                                    </div>
                                    <div class="col-9">
                                        <h6 class="fs-6">{{ $guide->user->name }}</h6>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <h5>No guiders available !</h5>
                    @endif
                @endif
            </div>
        </div>

        <div class="col-10">
            @foreach ($administrative_regions as $administrative_region)
                <div class="row p-4">
                    <h5>
                        {{ $administrative_region->id }} . {{ $administrative_region->name }}
                        <span class="float-end">
                            <a class="btn btn-primary rounded-pill"
                                href="{{ route('contents.regions', $administrative_region->id) }}" role="button">View
                                all</a>
                        </span>
                    </h5>
                </div>
                <div class="row row-cols-md-4 rounded">

                    @foreach ($administrative_region->regions as $region)
                        @if ($region->is_active)
                            <div class="row">
                                <div class="col m-3">

                                    <div class="card h-100 shadow border-light">
                                        <img src="{{ asset($region->card_photo) }}" class="card-img"
                                            alt="{{ $region->card_photo }}" height="150" width="150">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $region->name }}</h5>
                                            <p class="card-text">{{ $region->card_description }}</p>
                                        </div>
                                        <hr>
                                        <a class="icon-link icon-link-hover p-3"
                                            style="--bs-link-hover-color-rgb: 25, 135, 84;"
                                            href="{{ route('contents.landmarks', $region->id) }}">
                                            View more
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                                <use xlink:href="#arrow-right"></use>
                                            </svg>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
            {{-- <div class="pagination justify-content-center">
                    {{ $administrative_regions->links() }}
                </div> --}}
        </div>
    </div>
@endsection
