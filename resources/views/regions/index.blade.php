@extends('layouts.app')

@section('content')
    <h2 style="text-align-last: center" class="bg-info bg-opacity-10 border border-info rounded m-4"><b>Cities</b></h2>
    <div class="row row-cols-1 row-cols-md-4 g-4 m-4 shadow p-3 mb-5 bg-body-tertiary rounded">

        @foreach ($regions as $region)
            @if ($region->type === 'City')

                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('images/' . $region->card_photo) }}" class="rounded" alt="{{ $region->card_photo }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $region->name }}</h5>
                            <p class="card-text">{{ $region->card_description }}</p>
                        </div>
                        <a href="{{ route('regions.show', $region->id) }}" class="btn btn-primary">More</a>
                    </div>
                </div>
            @endif
        @endforeach

    </div>

    <h2 style="text-align-last: center" class="bg-info bg-opacity-10 border border-info rounded m-4"><b>Islands</b></h2>
    <div class="row row-cols-1 row-cols-md-4 g-4 m-4 shadow p-3 mb-5 bg-body-tertiary rounded">
        @foreach ($regions as $region)
            @if ($region->type === 'Island')
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('images/' . $region->card_photo) }}" class="rounded" alt="{{ $region->card_photo }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $region->name }}</h5>
                            <p class="card-text">{{ $region->card_description }}</p>
                        </div>
                        <a href="{{ route('regions.show', $region->id) }}" class="btn btn-primary">More</a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
