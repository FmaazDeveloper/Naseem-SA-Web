@extends('layouts.app')

@section('content')
    <h1 style="text-align-last: center" class="p-3 bg-success bg-opacity-10 border border-success border-start-0 rounded-end">Cities</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 m-3">

        @foreach ($cities as $city)
            @if ($city->type == 'City')
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('images/' . $city->card_photo) }}" class="img-fluid" alt="{{ $city->card_photo }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $city->name }}</h5>
                            <p class="card-text">{{ $city->card_description }}</p>
                        </div>
                        <a href="{{ route('regions.show', $city->id) }}" class="btn btn-primary">More</a>
                    </div>
                </div>
            @endif
        @endforeach

    </div>

    <h2 style="text-align-last: center" class="p-3 bg-success bg-opacity-10 border border-success border-start-0 rounded-end">Islands</h2>
    <div class="row row-cols-1 row-cols-md-4 g-4 m-3">
        @foreach ($cities as $city)
            @if ($city->type == 'Island')
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('images/' . $city->card_photo) }}" class="img-fluid" alt="{{ $city->card_photo }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $city->name }}</h5>
                            <p class="card-text">{{ $city->card_description }}</p>
                        </div>
                        <a href="{{ route('regions.show', $city->id) }}" class="btn btn-primary">More</a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
