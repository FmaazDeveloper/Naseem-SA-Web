@extends('layouts.dashboard')

@section('contents')
    <div class="row border rounded-3 bg-light m-5">
        <div class="col">
            <div class="row text-dark text-center m-2 border-dark border-bottom">
                <div class="card-header">
                    <h4>
                        Orders
                    <span class="float-end fs-5">{{ $all_orders->count() }}</span>
                    </h4>
                </div>
            </div>
            <div class="row rounded text-center">

                <div class="col m-3">
                    <div class="card shadow text-bg-primary m-1">
                        <div class="card-header">Completed Orders</div>
                        <div class="card-body">
                            {{ $complete_orders }}
                        </div>
                    </div>
                </div>

                <div class="col m-3">
                    <div class="card shadow text-bg-success m-1">
                        <div class="card-header">Activied Orders</div>
                        <div class="card-body">
                            {{ $active_orders }}
                        </div>
                    </div>
                </div>

                <div class="col m-3">
                    <div class="card shadow text-bg-warning m-1">
                        <div class="card-header">Pending Orders</div>
                        <div class="card-body">
                            {{ $pending_orders }}
                        </div>
                    </div>
                </div>

                <div class="col m-3">
                    <div class="card shadow text-bg-danger m-1">
                        <div class="card-header">Cancel Orders</div>
                        <div class="card-body">
                            {{ $cancel_orders }}
                        </div>
                    </div>
                </div>

                <div class="col m-3">
                    <div class="card shadow text-bg-secondary m-1">
                        <div class="card-header">Reject Orders</div>
                        <div class="card-body">
                            {{ $reject_orders }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row bg-primary text-white rounded-3 text-center">
            <h3>Managing Orders</h3>
        </div>
    </div>
    <div class="row">
        @yield('form')
    </div>
@endsection
