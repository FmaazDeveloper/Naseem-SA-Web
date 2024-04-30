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
                        @if ($orders->count() > 0)
                            @foreach ($orders as $order)
                                @if ($order->status_id == 3)
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
                                                    <td>{{ $order->age }}</td>
                                                    <td>{{ $order->gender }}</td>
                                                    <td>{{ $order->nationality }}</td>
                                                    <td>{{ $order->language }}</td>
                                                    <td>
                                                        <a href="https://wa.me/+966{{ $order->phone_number }}"
                                                            target="_blanck">
                                                            {{ $order->phone_number }}
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
                                    {{-- <div class="text-center m-2">
                                        <form method="post" action="{{ route('orders.update', $order->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" name="status_id" value="5"
                                                class="btn btn-danger">End the
                                                trip</button>
                                        </form>
                                    </div> --}}
                                @elseif($order->status_id == 4)
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
                                                        <form method="post"
                                                            action="{{ route('orders.update', $order->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" name="status_id" value="3"
                                                                class="btn btn-success">Accept</button>
                                                            <button type="submit" name="status_id" value="7"
                                                                class="btn btn-danger">Reject</button>

                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                @endif
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
