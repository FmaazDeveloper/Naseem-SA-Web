@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row m-5">
            <div class="col m-3">
                <div class="card h-100">
                    @if (session('msg'))
                        <div class="text-center alert alert-success">{{ session('msg') }}</div>
                    @endif
                    <div class="card-header">
                        <h4>
                            Request Tour Guide
                            <a href="{{ route('request_orders.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">
                        @if (is_null($actived_order) && is_null($pending_order))
                            <form method="post" action="{{ route('request_orders.store', $guide->id) }}">
                                @csrf

                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="number_of_people" class="form-label">Number of people</label>
                                            <input name="number_of_people" type="text"
                                                value="{{ old('number_of_people') }}" class="form-control"
                                                id="number_of_people">
                                            @error('number_of_people')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Start date</label>
                                            <input name="start_date" type="date" value="{{ old('start_date') }}"
                                                class="form-control" id="start_date">
                                            @error('start_date')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">End date</label>
                                            <input name="end_date" type="date" value="{{ old('end_date') }}"
                                                class="form-control" id="end_date">
                                            @error('end_date')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="status" value="Pending" class="btn btn-success">Request</button>

                            </form>
                        @elseif (!is_null($actived_order))
                            <div class="text-center">
                                <h4>Your Guide information</h4>
                                <table class="table table-success">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Age</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Nationality</th>
                                            <th scope="col">Language</th>
                                            <th scope="col">Phone number</th>
                                            <th scope="col">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $actived_order->id }}</th>
                                            <td>{{ $actived_order->guide->name }}</td>
                                            <td>{{ $actived_order->age }}</td>
                                            <td>{{ $actived_order->gender }}</td>
                                            <td>{{ $actived_order->nationality }}</td>
                                            <td>{{ $actived_order->language }}</td>
                                            <td>
                                                <a href="https://wa.me/+966{{ $actived_order->phone_number }}"
                                                    target="_blanck">
                                                    {{ $actived_order->phone_number }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $actived_order->guide->email }}" target="_blanck">
                                                    {{ $actived_order->guide->email }}
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center m-2">
                                <form method="post" action="{{ route('request_orders.update', $actived_order->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="status" value="Completed" class="btn btn-danger">End the trip</button>
                                </form>
                            </div>
                        @elseif(!is_null($pending_order))
                            <div class="text-center">
                                <h4>Your trip information</h4>
                                <table class="table table-success">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tourist name</th>
                                            <th scope="col">Region</th>
                                            <th scope="col">Number of people</th>
                                            <th scope="col">Start date</th>
                                            <th scope="col">End date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $pending_order->id }}</th>
                                            <td>{{ $pending_order->tourist->name }}</td>
                                            <td>{{ $pending_order->region->name }}</td>
                                            <td>{{ $pending_order->number_of_people }}</td>
                                            <td>{{ $pending_order->start_date }}</td>
                                            <td>{{ $pending_order->end_date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p>Witing for the guide <b>{{ $pending_order->guide->name }}</b> ...</p>
                                <div class="spinner-border text-success" role="status"></div>

                            </div>
                            <div class="text-center m-2">
                                <form method="post" action="{{ route('request_orders.update', $pending_order->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="status" value="Canceled"
                                        class="btn btn-danger">Cancel</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-5 p-3 rounded-3" style="background-image: url(/images/pages/guide_page.jpg)">
            @if (!is_null($guide))
                <div class="col-md-3 mx-auto justify-content-center m-auto text-center opacity-75">
                    <div class="col p-2">
                        <img src="{{ asset($guide->photo ?? 'images/profile_icons/profile_image.png') }}" alt=""
                            width="100" height="100" class="border border-dark rounded-circle" !important>
                    </div>
                    <div class="col shadow bg-light p-3 rounded-5">
                        <div class="row">

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/name.png') }}" alt="" width="33"
                                    height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $guide->user->name }}
                            </div>
                            </p>

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/age.png') }}" alt="" width="33"
                                    height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $guide->age ?? 'No data found' }}
                            </div>
                            </p>

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/gender.png') }}" alt="" width="33"
                                    height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $guide->gender ?? 'No data found' }}
                            </div>
                            </p>

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/nationality.png') }}" alt=""
                                    width="33" height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $guide->nationality ?? 'No data found' }}
                            </div>
                            </p>

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/language.png') }}" alt=""
                                    width="33" height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $guide->language ?? 'No data found' }}
                            </div>
                            </p>

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/region.png') }}" alt="" width="33"
                                    height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                {{ $guide->region ? $guide->region->administrative_region->name . ' / ' . $guide->region->type . ' / ' . $guide->region->name : 'No data found' }}
                            </div>
                            </p>

                            <p>
                            <div class="col-3">
                                <img src="{{ asset('images/profile_icons/certificate.png') }}" alt=""
                                    width="33" height="33" !important>
                            </div>
                            <div class="col-9 text-start">
                                @if (!is_null($guide->certificate))
                                    <a href="{{ url($guide->certificate) }}" target="_blank">View</a>
                                @else
                                    No data found
                                @endif
                            </div>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-md-8 shadow bg-light rounded-5 opacity-75">
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
                </div>
            @else
                <h4 class="text-center">
                    No data found
                </h4>
            @endif
        </div>
    </div>
@endsection
