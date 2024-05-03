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
                            Accept tourist order
                        </h4>
                    </div>
                    <div class="card-body m-3">
                        @if ($actived_orders->count() > 0)
                            @foreach ($actived_orders as $order)
                                <div class="text-center">
                                    <h4>Tourist information</h4>
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
                                                <th scope="row">{{ $order->id }}</th>
                                                <td>{{ $order->tourist->name }}</td>
                                                <td>{{ $order->tourist->profile->age }}</td>
                                                <td>{{ $order->tourist->profile->gender }}</td>
                                                <td>{{ $order->tourist->profile->nationality }}</td>
                                                <td>{{ $order->tourist->profile->language }}</td>
                                                <td>
                                                    <a href="https://wa.me/+966{{ $order->tourist->profile->phone_number }}" target="_blanck">
                                                        {{ $order->tourist->profile->phone_number }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="mailto:{{ $order->tourist->email }}" target="_blanck">
                                                        {{ $order->tourist->email }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        @elseif($pending_orders->count() > 0)
                            @foreach ($pending_orders as $order)
                                <div class="text-center">
                                    <table class="table table-success">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tourist name</th>
                                                <th scope="col">Region</th>
                                                <th scope="col">Number of people</th>
                                                <th scope="col">Start date</th>
                                                <th scope="col">End date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">{{ $order->id }}</th>
                                                <td>{{ $order->tourist->name }}</td>
                                                <td>{{ $order->region->name }}</td>
                                                <td>{{ $order->number_of_people }}</td>
                                                <td>{{ $order->start_date }}</td>
                                                <td>{{ $order->end_date }}</td>
                                                <td>
                                                    <form method="post" action="{{ route('request_orders.update', $order->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" name="status" value="Actived"
                                                            class="btn btn-success">Accept</button>
                                                        <button type="submit" name="status" value="Rejected"
                                                            class="btn btn-danger">Reject</button>

                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            @endforeach
                        @else
                            No orders yet
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
