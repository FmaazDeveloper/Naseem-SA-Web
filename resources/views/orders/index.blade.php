@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    @if (session('msg'))
                        <div class="text-center alert alert-success">{{ session('msg') }}</div>
                    @endif
                    <div class="card-header">
                        <h4>
                            Select region
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-1 rounded">
                            @foreach ($regions as $region)
                                @if ($region->guides->count() > 0)
                                    <div class="card mb-3">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col">
                                                    <img src="{{ asset($region->card_photo) }}" height="50"
                                                        width="50" class="rounded-3" alt="{{ $region->name }}">
                                                </div>
                                                <div class="col">
                                                    <h4>{{ $region->name }}</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="card-body">
                                                    <div class="row row-cols-1 row-cols-md-4 rounded">

                                                        @foreach ($guides as $guide)
                                                            <div class="col">
                                                                <a href="{{ route('request_orders.create', $guide->user_id) }}"
                                                                    class="link-success link-offset-2 link-underline link-underline-opacity-0">
                                                                    <div
                                                                        class="row rounded-2 m-2 p-1 border-2 border-secondary">
                                                                        <div class="col-3">
                                                                            <img src="{{ $guide->photo ?? 'images/profile_icons/profile_image.png' }}"
                                                                                class="rounded-circle" alt=""
                                                                                width="50" height="50">
                                                                        </div>
                                                                        <div class="col-9">
                                                                            <h6 class="fs-6">
                                                                                {{ $guide->user->name }}
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @else
                                        <h3 class="text-center">Not found</h3> --}}
                                @endif
                            @endforeach
                        </div>
                        <div class="pagination justify-content-center">
                            {{ $regions->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
