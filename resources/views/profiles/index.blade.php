@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row m-5">
            @if (session('msg'))
                <div class="text-center alert alert-success">{{ session('msg') }}</div>
            @endif

            @if (!is_null($profile))
                <div class="col-md-4 mx-auto justify-content-center m-auto text-center">
                    <div class="col p-2">
                        <img src="{{ asset($profile->photo ?? 'images/profile_icons/profile_image.png') }}"
                            alt="" width="100" height="100" class="border border-dark rounded-circle" !important>
                    </div>
                    @if (!$profile->user->is_active)
                        <p class="text-danger">*Your acount unactive</p>
                    @endif
                    <div class="col shadow bg-light p-3 rounded-5">
                        <div class="row">

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/name.png') }}" width="33"
                                    height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $profile->user->name }}
                            </div>
                            </p>

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/email.png') }}" width="33"
                                    height="33" !important>
                            </div>
                            <div class="col-6 text-start">
                                {{ $profile->user->email }}
                            </div>
                            <div class="col-3 text-end">
                                @if (!is_null($profile->user->email_verified_at))
                                    <img src="{{ asset('images/profile_icons/verified.png') }}" width="25"
                                        height="25">
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
                                <img src="{{ asset('images/profile_icons/phone_number.png') }}"
                                    width="33" height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $profile->phone_number ?? 'No data found' }}
                            </div>
                            </p>

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/age.png') }}" width="33"
                                    height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $profile->age ?? 'No data found' }}
                            </div>
                            </p>

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/gender.png') }}" width="33"
                                    height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $profile->gender ?? 'No data found' }}
                            </div>
                            </p>

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/nationality.png') }}"
                                    width="33" height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $profile->nationality ?? 'No data found' }}
                            </div>
                            </p>

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/language.png') }}" width="33"
                                    height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $profile->language ?? 'No data found' }}
                            </div>
                            </p>

                            @if ($profile->user->role == 'guide')
                                <p>
                                <div class="col-3">
                                    <img src="{{ asset('images/profile_icons/region.png') }}" width="33"
                                        height="33" !important>
                                </div>
                                <div class="col-9 text-start">
                                    {{ $profile->region ? $profile->region->administrative_region->name . ' / ' . $profile->region->type . ' / ' . $profile->region->name : 'No data found' }}
                                </div>
                                </p>

                                <p>

                                <div class="col-3">
                                    <img src="{{ asset('images/profile_icons/certificate.png') }}"
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
                        <a href="{{ route('profiles.edit', Auth::user()->id) }}" class="btn btn-success">Update
                            Profile</a>
                    </div>

                </div>

                <div class="col-md-8 shadow bg-light rounded-5">

                    <div class="row">
                        {{-- Tickets --}}
                        <div class="row">
                            <div class="row m-3">
                                Number of tickets is : {{ $tickets->count() }}
                                <div class="row row-cols-1 row-cols-md-2">
                                    @foreach ($tickets as $ticket)
                                        <div class="row">
                                            <div class="col m-1">
                                                <div class="card h-100">
                                                    @if ($tickets->count() > 0)
                                                        <div class="card-body">
                                                            <table>
                                                                <tr>
                                                                    <td>ID : </td>
                                                                    <td class="text-center">{{ $ticket->id }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Title : </td>
                                                                    <td class="text-center">{{ $ticket->title }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Status : </td>
                                                                    <td class="text-center">{{ $ticket->status }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Created at : </td>
                                                                    <td class="text-center">{{ $ticket->created_at }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="card-footer">
                                                            <small class="text-muted">
                                                                    <h6 class="text-center">Closed at : {{ $ticket->closed_at }}</h6>
                                                            </small>
                                                        </div>
                                                    @else
                                                        <div class="card-body">
                                                            No data found !
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="pagination justify-content-center">
                                    {{ $tickets->links() }}
                                </div>
                            </div>
                        </div>
                        {{-- Orders --}}
                        <div class="row m-3">
                            Number of orders is : {{ $orders->count() }}
                            <div class="row row-cols-1 row-cols-md-2 rounded">
                                @foreach ($orders as $order)
                                    <div class="row">
                                        <div class="col m-1">
                                            <div class="card h-100 rounded-3">
                                                @if ($orders->count() > 0)
                                                    <div class="card-body">
                                                        <table>
                                                            <tr>
                                                                <td>ID : </td>
                                                                <td class="text-center">{{ $order->id }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Region : </td>
                                                                <td class="text-center">{{ $order->region->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Participants : </td>
                                                                <td class="text-center">{{ $order->number_of_people }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Start date : </td>
                                                                <td class="text-center">{{ $order->start_date }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>End date : </td>
                                                                <td class="text-center">{{ $order->end_date }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="card-footer">
                                                        <small class="text-muted">
                                                                <h6 class="text-center">Closed at : {{ $order->closed_at }}</h6>
                                                        </small>
                                                    </div>
                                                @else
                                                    <div class="card-body">
                                                        No data found !
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="pagination justify-content-center">
                                {{ $orders->links() }}
                            </div>
                        </div>
                        @if ($profile->user->role == 'guide')
                            {{-- Overview --}}
                            <div class="row m-3">
                                <p>
                                <div class="row">
                                    <div class="col-1">
                                        <img src="{{ asset('images/profile_icons/overview.png') }}" alt=""
                                            width="33" height="33" !important>
                                    </div>
                                    <div class="col-11 text-start">
                                        {{ $profile->overview ?? 'No data found' }}
                                    </div>
                                </div>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- @else
                <h4 class="text-center">
                    No data found ! Please update your profile information
                    <a href="{{ route('profiles.create', Auth::user()->id) }}" class="btn btn-success">Update Profile</a>
                </h4> --}}
            @endif
        </div>
    </div>
@endsection
