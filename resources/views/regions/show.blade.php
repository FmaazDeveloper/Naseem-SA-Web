@extends('layouts.app')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 g-4 m-3">

        @foreach ($region->landmarks as $landmark)
            <div class="card mb-3">
                <img src="{{ asset('images/' . $landmark->photo) }}" class="card-img-top" alt="{{ $landmark->photo }}"
                    height="250">
                <div class="card-body">
                    <h5 class="card-title">{{ $landmark->name }}</h5>
                    <ul>
                        @foreach ($landmark->activities as $activity)
                            <li>{{ $activity->description }}</>
                        @endforeach
                    </ol>
                    <p class="card-text"><small class="text-body-secondary">Last updated in {{ $landmark->updated_at }}</small>
                    </p>
                </div>
            </div>
        @endforeach

    </div>
@endsection
