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
                            Select your Guide
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-1 rounded">
                            @foreach ($regions as $region)
                                @if ($region->guides->count() > 0)
                                    <div class="card">
                                        <div class="row">
                                            <div class="row m-1">
                                                <div class="col">
                                                    <img src="{{ asset($region->card_photo) }}" height="50"
                                                        width="50" class="rounded-3" alt="{{ $region->name }}">
                                                </div>
                                                <div class="col">
                                                    <h4>{{ $region->name }}</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row m-1">
                                                <div class="card-body">
                                                    <div class="row row-cols-1 row-cols-md-2 rounded">

                                                        @foreach ($region->guides as $guide)
                                                            <div class="row">
                                                                <div class="col border border-secondary rounded-3 m-1">
                                                                    <a href="{{ route('request_orders.create', $guide->user_id) }}"
                                                                        class="link-success link-offset-2 link-underline link-underline-opacity-0">
                                                                        <div
                                                                            class="row rounded-2 p-1 border-2 border-secondary">
                                                                            <div class="col-2 text-center">
                                                                                <img src="{{ '/' . $guide->photo ?? '/images/profile_icons/profile_image.png' }}"
                                                                                    class="rounded-circle justify-content-center"
                                                                                    alt="" width="50"
                                                                                    height="50">
                                                                                <h6>
                                                                                    @if (!is_null($guide->certificate))
                                                                                        <img src="{{ asset('images/profile_icons/verified.png') }}"
                                                                                            width="25" height="25">
                                                                                    @else
                                                                                        <img src="{{ asset('images/profile_icons/unverified.png') }}"
                                                                                            width="25" height="25">
                                                                                    @endif
                                                                                </h6>
                                                                            </div>
                                                                            <div class="col-10">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <h6>
                                                                                            <img src="{{ asset('images/profile_icons/name.png') }}"
                                                                                                width="25"
                                                                                                height="25">
                                                                                            {{ $guide->user->name }}
                                                                                        </h6>
                                                                                        <h6>
                                                                                            <img src="{{ asset('images/profile_icons/gender.png') }}"
                                                                                                width="25"
                                                                                                height="25">
                                                                                            {{ $guide->gender }}
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <h6>
                                                                                            <img src="{{ asset('images/profile_icons/language.png') }}"
                                                                                                width="25"
                                                                                                height="25">
                                                                                            {{ $guide->language }}
                                                                                        </h6>
                                                                                        <h6>
                                                                                            <img src="{{ asset('images/profile_icons/nationality.png') }}"
                                                                                                width="25"
                                                                                                height="25">
                                                                                            {{ $guide->nationality }}
                                                                                        </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-body-secondary">
                                                Number of Guiders is : {{ $region->guides->count() }}
                                              </div>
                                        </div>
                                    </div>
                                    {{-- <hr> --}}
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
