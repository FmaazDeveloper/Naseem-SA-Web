@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @if (session('msg'))
                <div class="text-center alert alert-success">{{ session('msg') }}</div>
            @endif

            @if (!is_null($profile))
                <div class="col-md-3 mx-auto justify-content-center m-auto text-center">
                    <div class="col p-2">
                        <img src="{{ asset($profile->photo ? $profile->photo : 'images/profile_icons/profile_image.png') }}"
                            alt="" width="100" height="100" class="border border-dark rounded-circle" !important>
                    </div>
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
                            <div class="col-9 text-start">
                                {{ $profile->user->email }}
                            </div>
                            </p>

                            @foreach ($keys as $key)
                                <p>
                                <div class="col-3">
                                    <img src="{{ asset('images/profile_icons/' . $key . '.png') }}" alt=""
                                        width="33" height="33" !important>
                                </div>
                                <div class="col-9 text-start">
                                    {{ $profile->$key ? $profile->$key : 'No data found' }}
                                </div>
                                </p>
                            @endforeach
                        </div>
                        <a href="{{ route('profiles.edit', $profile->user->id) }}" class="btn btn-success">Update Profile</a>
                    </div>

                </div>
                <div class="col-md-8 shadow bg-light rounded-5">

                    user data
                </div>
            @else
                <h4 class="text-center">
                    No data found ! Please update your profile information
                    <a href="{{ route('profiles.create', Auth::user()->id) }}" class="btn btn-success">Update Profile</a>
                </h4>
            @endif
        </div>
    </div>
@endsection


{{-- <div class="row">

    <p>
    <div class="col-3">
        <img src="{{ asset('images/profile_icons/name.png') }}" alt="" width="33" height="33" !important>
    </div>
    <div class="col-9 text-start">
        {{ $profile->user->name }}
    </div>
    </p>

    <p>
    <div class="col-3">
        <img src="{{ asset('images/profile_icons/email.png') }}" alt="" width="33" height="33"
            !important>
    </div>
    <div class="col-9 text-start">
        {{ $profile->user->email }}
    </div>
    </p>

    <p>
    <div class="col-3">
        <img src="{{ asset('images/profile_icons/phone_number.png') }}" alt="" width="33" height="33"
            !important>
    </div>
    <div class="col-9 text-start">
        {{ $profile->phone_number }}
    </div>
    </p>

    <p>
    <div class="col-3">
        <img src="{{ asset('images/profile_icons/age.png') }}" alt="" width="33" height="33"
            !important>
    </div>
    <div class="col-9 text-start">
        {{ $profile->age }}
    </div>
    </p>

    <p>
    <div class="col-3">
        <img src="{{ asset('images/profile_icons/gender.png') }}" alt="" width="33" height="33"
            !important>
    </div>
    <div class="col-9 text-start">
        {{ $profile->gender }}
    </div>
    </p>

    <p>
    <div class="col-3">
        <img src="{{ asset('images/profile_icons/nationality.png') }}" alt="" width="33" height="33"
            !important>
    </div>
    <div class="col-9 text-start">
        {{ $profile->nationality }}
    </div>
    </p>

    <p>
    <div class="col-3">
        <img src="{{ asset('images/profile_icons/language.png') }}" alt="" width="33" height="33"
            !important>
    </div>
    <div class="col-9 text-start">
        {{ $profile->language }}
    </div>
    </p>

</div> --}}
