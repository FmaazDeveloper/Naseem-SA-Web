@extends('layouts.dashboard')

@section('contents')
    <div class="container">

        @foreach ($administrative_regions as $administrative_region)
            <div class="row border rounded-3 bg-light m-5">
                <div class="col">
                    <div class="row text-dark text-center m-2 border-dark border-bottom">
                        <h4>
                            {{ $administrative_region->name }}
                            <span class="float-end">
                                {{ $orders[$administrative_region->id] }}
                            </span>
                        </h4>
                    </div>
                    <div class="row rounded text-center">

                        <div class="col m-3">
                            <div class="card text-bg-primary m-1">
                                <div class="card-header">Completed Orders</div>
                                <div class="card-body">
                                    {{ $complete_orders[$administrative_region->id] }}
                                </div>
                            </div>
                        </div>

                        <div class="col m-3">
                            <div class="card text-bg-success m-1">
                                <div class="card-header">Activied Orders</div>
                                <div class="card-body">
                                    {{ $active_orders[$administrative_region->id] }}
                                </div>
                            </div>
                        </div>

                        <div class="col m-3">
                            <div class="card text-bg-warning m-1">
                                <div class="card-header">Pending Orders</div>
                                <div class="card-body">
                                    {{ $pending_orders[$administrative_region->id] }}
                                </div>
                            </div>
                        </div>

                        <div class="col m-3">
                            <div class="card text-bg-danger m-1">
                                <div class="card-header">Cancel Orders</div>
                                <div class="card-body">
                                    {{ $cancel_orders[$administrative_region->id] }}
                                </div>
                            </div>
                        </div>

                        <div class="col m-3">
                            <div class="card text-bg-secondary m-1">
                                <div class="card-header">Reject Orders</div>
                                <div class="card-body">
                                    {{ $reject_orders[$administrative_region->id] }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
