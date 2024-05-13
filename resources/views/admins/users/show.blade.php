@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row m-5">
            @if (session('msg'))
                <div class="text-center alert alert-success">{{ session('msg') }}</div>
            @endif

            <div class="col-md-4 mx-auto justify-content-center m-auto text-center">
                <div class="col p-2">
                    <img src="{{ asset($profile->photo ? $profile->photo : 'images/profile_icons/profile_image.png') }}"
                        alt="" width="100" height="100" class="border border-dark rounded-circle" !important>
                </div>
                @if (!$profile->user->is_active)
                    <p class="text-danger">*Your acount unactive</p>
                @endif
                <div class="col shadow bg-light p-3 rounded-5">
                    <div class="row">

                        <p>
                        <div class="col-3">
                            <img src="{{ asset('images/profile_icons/name.png') }}" alt="" width="33"
                                height="33" !important>
                        </div>
                        <div class="col-9 text-start">
                            {{ $profile->user->name }}
                        </div>
                        </p>

                        <p>
                        <div class="col-3">
                            <img src="{{ asset('images/profile_icons/email.png') }}" alt="" width="33"
                                height="33" !important>
                        </div>
                        <div class="col-6 text-start">
                            {{ $profile->user->email }}
                        </div>
                        <div class="col-3 text-end">
                            @if (!is_null($profile->user->email_verified_at))
                                <img src="{{ asset('images/profile_icons/verified.png') }}" width="25" height="25">
                            @else
                                <a href="{{ route('verification.notice') }}">
                                    <img src="{{ asset('images/profile_icons/unverified.png') }}" width="25"
                                        height="25">
                                </a>
                            @endif
                        </div>
                        </p>

                        <p>
                        <div class="col-3">
                            <img src="{{ asset('images/profile_icons/phone_number.png') }}" alt="" width="33"
                                height="33" !important>
                        </div>
                        <div class="col-9 text-start">
                            {{ $profile->phone_number ?? 'No data found' }}
                        </div>
                        </p>

                        <p>
                        <div class="col-3">
                            <img src="{{ asset('images/profile_icons/age.png') }}" alt="" width="33"
                                height="33" !important>
                        </div>
                        <div class="col-9 text-start">
                            {{ $profile->age ?? 'No data found' }}
                        </div>
                        </p>

                        <p>
                        <div class="col-3">
                            <img src="{{ asset('images/profile_icons/gender.png') }}" alt="" width="33"
                                height="33" !important>
                        </div>
                        <div class="col-9 text-start">
                            {{ $profile->gender ?? 'No data found' }}
                        </div>
                        </p>

                        <p>
                        <div class="col-3">
                            <img src="{{ asset('images/profile_icons/nationality.png') }}" alt="" width="33"
                                height="33" !important>
                        </div>
                        <div class="col-9 text-start">
                            {{ $profile->nationality ?? 'No data found' }}
                        </div>
                        </p>

                        <p>
                        <div class="col-3">
                            <img src="{{ asset('images/profile_icons/language.png') }}" alt="" width="33"
                                height="33" !important>
                        </div>
                        <div class="col-9 text-start">
                            {{ $profile->language ?? 'No data found' }}
                        </div>
                        </p>

                        @if ($profile->user->role == 'guide')
                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/region.png') }}" alt="" width="33"
                                    height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $profile->region ? $profile->region->administrative_region->name . ' / ' . $profile->region->type . ' / ' . $profile->region->name : 'No data found' }}
                            </div>
                            </p>

                            <p>

                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/certificate.png') }}" alt=""
                                    width="33" height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                @if (!is_null($profile->certificate))
                                    <a href="{{ url($profile->certificate) }}" target="_blank">View</a>
                                @else
                                    No data found
                                @endif
                            </div>
                            </p>
                        @endif

                    </div>
                    <a href="{{ route('users.edit_profile', $profile->user_id) }}" class="btn btn-success">Update
                        Profile</a>
                </div>

            </div>


            <div class="col-md-8 shadow bg-light rounded-5">

                <div class="row">
                    {{-- Tickets --}}
                    <div class="row m-3">
                        Number of tickets is : {{ $profile->user->tickets->count() }}
                        <div class="row row-cols-1 row-cols-md-3 rounded">
                            @foreach ($profile->user->tickets as $ticket)
                                <div class="col">
                                    <div class="card h-100">
                                        @if ($tickets->count() > 0)
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $ticket->title }}</h6>
                                                <p class="card-text">{{ $ticket->message }}</p>
                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted">
                                                    <p>Created at : {{ $ticket->created_at }}</p>
                                                    <p>Closed at : {{ $ticket->closed_at }}</p>
                                                </small>
                                            </div>
                                        @else
                                            <div class="card-body">
                                                No data found !
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Orders --}}
                    <div class="row m-3">
                        Number of orders is : {{ $orders->count() }}
                        <div class="row row-cols-1 row-cols-md-3 rounded">
                            @foreach ($orders as $order)
                                <div class="col">
                                    <div class="card h-100">
                                        @if ($orders->count() > 0)
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $order->region->name }}</h6>
                                                <p class="card-text">{{ $order->message }}</p>
                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted">
                                                    <span>Created at : {{ $order->created_at }}
                                                        Closed at : {{ $order->closed_at }}</span>
                                                </small>
                                            </div>
                                        @else
                                            <div class="card-body">
                                                No data found !
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if ($profile->user->role == 'guide')
                        {{-- Overview --}}
                        <div class="row m-3">
                            <div class="row row-cols-1 row-cols-md-3 rounded">
                                <p>
                                <div class="col-3">
                                    <img src="{{ asset('images/profile_icons/overview.png') }}" alt=""
                                        width="33" height="33" !important>
                                </div>
                                <div class="col-9 text-start">
                                    {{ $profile->overview ?? 'No data found' }}
                                </div>
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
