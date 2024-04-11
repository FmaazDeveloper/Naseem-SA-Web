@extends('layouts.app')

@section('content')
    <h2 style="text-align-last: center" class="bg-info bg-opacity-10 border border-info rounded m-4">
        {{ $region->type == 'City' ? 'The ' . $region->name . ' city' : 'The ' . $region->name . ' island' }}
    </h2>
    <div class="row row-cols-1 row-cols-md-2 g-4 m-4">
        @foreach ($region->landmarks as $landmark)
            @if ($landmark->is_active)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header text-center">
                            {{ $landmark->name }}
                        </div>
                        <img src="{{ asset('images/' . $landmark->photo) }}" class="rounded" alt="{{ $landmark->photo }}"
                            height="250">
                        <div class="card-body">
                            <h5 class="card-title">{{ $landmark->description }}</h5>
                            <ul>
                                @foreach ($landmark->activities as $activity)
                                    @if ($activity->is_active)
                                        <li>{{ $activity->description }}</li>
                                    @endif
                                @endforeach
                            </ul>
                            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                        </div>
                        <div class="card-footer text-body-secondary text-center">
                            Last updated in {{ $landmark->updated_at }}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
