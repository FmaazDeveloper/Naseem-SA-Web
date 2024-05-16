@extends('layouts.dashboard')

@section('contents')
    <div class="row border rounded-3 bg-light m-5">
        <div class="col">
            <div class="row text-dark text-center m-2 border-dark border-bottom">
                <div class="card-header">
                    <h4>
                        Tickets
                        <span class="float-end fs-5">{{ $all_tickets->count() }}</span>
                    </h4>
                </div>
            </div>

            <div class="card-body row">

                @foreach ($contact_reasons as $contact_reason)
                    <div class="col m-3">
                        <div class="card shadow text-bg-light m-1">
                            <div class="card-header text-center">
                                <h6>{{ $contact_reason->name }}</h6>
                            </div>
                            <div class="card-body">
                                <h6>
                                    <ul>
                                        <li class="text-success">
                                            New :
                                            <span class="float-end">
                                                {{ $new_tickets[$contact_reason->id] }}
                                            </span>
                                        </li>
                                        <li class="text-danger">
                                            Closed :
                                            <span class="float-end">
                                                {{ $closed_tickets[$contact_reason->id] }}
                                            </span>
                                        </li>
                                    </ul>
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
    <div class="container">
        <div class="row bg-primary text-white rounded-3 text-center">
            <h3>Managing Tickets</h3>
        </div>
    </div>
    <div class="row">
        @yield('form')
    </div>
@endsection
