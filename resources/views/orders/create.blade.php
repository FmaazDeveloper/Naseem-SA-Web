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
                            Request Tour Guide
                        </h4>
                    </div>
                    @if (is_null($tourist) || $tourist->status_id != 4)

                        <div class="card-body">
                            <form method="post" action="{{ route('orders.store', $region_id) }}"
                                enctype="multipart/form-data">

                                @csrf
                                <div class="row">

                                    <div class="col-8">
                                        <div class="row row-cols-1 row-cols-md-4 rounded">

                                            @foreach ($regions as $region)
                                                <a href="{{ route('orders.create', $region->id) }}"
                                                    class="link-offset-2 link-underline link-underline-opacity-0">
                                                    <div class="card mb-3">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <img src="{{ asset($region->photo) }}" height="45"
                                                                    width="45" class="rounded-3"
                                                                    alt="{{ $region->name }}">
                                                            </div>
                                                            <div class="col-9">
                                                                <p class="text-center">{{ $region->name }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                        @error('region_id')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            @if (!is_null($guides))
                                                @if ($guides->count() > 0)
                                                    <h6>The region <b>{{ $region_id->name }}</b> have {{ $guides->count() }}
                                                        avaliable
                                                        Tour guides</h6>
                                                    <label for="guide_id" class="form-label"> Select tour guide </label>
                                                    <select class="form-select" name="guide_id"
                                                        aria-label="Default select example" id="region">
                                                        <option selected disabled>Select tour guide</option>
                                                        @foreach ($guides as $guide)
                                                            <option value="{{ $guide->user->id }}">
                                                                {{ $loop->index + 1 . ' - ' . $guide->user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('guide_id')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                @else
                                                    <p>Not founding any avaliable Tour guide !</p>
                                                @endif
                                            @else
                                                <p>Select region to view the avaliable Tour guides</p>
                                                <a href="{{ route('orders.create', $region->id) }}"></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Request</button>

                            </form>
                        </div>
                    @else
                        <div class="card-body">
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
                                            <th scope="row">{{ $tourist->id }}</th>
                                            <td>{{ $tourist->guide->name }}</td>
                                            <td>{{ $tourist->guide->profile->age }}</td>
                                            <td>{{ $tourist->guide->profile->gender }}</td>
                                            <td>{{ $tourist->guide->profile->nationality }}</td>
                                            <td>{{ $tourist->guide->profile->language }}</td>
                                            <td>
                                                <a href="https://wa.me/+966{{ $tourist->guide->profile->phone_number }}"
                                                    target="_blanck">
                                                    {{ $tourist->guide->profile->phone_number }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $tourist->guide->email }}" target="_blanck">
                                                    {{ $tourist->guide->email }}
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p>Witing for the guide...</p>
                                <div class="spinner-border text-success" role="status"></div>

                            </div>
                        </div>
                        <div class="text-center m-2">
                            <form action="{{ route('orders.update', $tourist->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="status_id" value="6" class="btn btn-danger">Cancel</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
