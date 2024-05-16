@extends('layouts.dashboard')

@section('contents')
    <div class="row border rounded-3 bg-light m-5">
        <div class="col">
            <div class="row text-dark text-center m-2 border-dark border-bottom">
                <div class="card-header">
                    <h4>
                        Contents
                        <span class="float-end fs-5">{{ $contentCount }}</span>
                    </h4>
                </div>
            </div>
            <div class="row rounded">

                <div class="col m-3">
                    <div class="card shadow text-bg-light m-1">
                        <div class="card-header text-center">
                            <h6 class="text-capitalize">
                                Administrative Regions
                            </h6>
                        </div>
                        <div class="card-body">
                            <h6>
                                <ul>
                                    <li class=" text-success">
                                        Active :
                                        <span class="float-end">
                                            {{ $administrativeRegionsActive }}
                                        </span>
                                    </li>
                                    <li class="text-danger">
                                        Unactive :
                                        <span class="float-end">
                                            {{ $administrativeRegionsUnactive }}
                                        </span>
                                    </li>
                                </ul>
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col m-3">
                    <div class="card shadow text-bg-light m-1">
                        <div class="card-header text-center">
                            <h6 class="text-capitalize">
                                Regions
                            </h6>
                        </div>
                        <div class="card-body">
                            <h6>
                                <ul>
                                    <li class=" text-success">
                                        Active :
                                        <span class="float-end">
                                            {{ $regionsActive }}
                                        </span>
                                    </li>
                                    <li class="text-danger">
                                        Unactive :
                                        <span class="float-end">
                                            {{ $regionsUnactive }}
                                        </span>
                                    </li>
                                </ul>
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col m-3">
                    <div class="card shadow text-bg-light m-1">
                        <div class="card-header text-center">
                            <h6 class="text-capitalize">
                                Landmarks
                            </h6>
                        </div>
                        <div class="card-body">
                            <h6>
                                <ul>
                                    <li class=" text-success">
                                        Active :
                                        <span class="float-end">
                                            {{ $landmarksActive }}
                                        </span>
                                    </li>
                                    <li class="text-danger">
                                        Unactive :
                                        <span class="float-end">
                                            {{ $landmarksUnactive }}
                                        </span>
                                    </li>
                                </ul>
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col m-3">
                    <div class="card shadow text-bg-light m-1">
                        <div class="card-header text-center">
                            <h6 class="text-capitalize">
                                Activities
                            </h6>
                        </div>
                        <div class="card-body">
                            <h6>
                                <ul>
                                    <li class=" text-success">
                                        Active :
                                        <span class="float-end">
                                            {{ $activitiesActive }}
                                        </span>
                                    </li>
                                    <li class="text-danger">
                                        Unactive :
                                        <span class="float-end">
                                            {{ $activitiesUnactive }}
                                        </span>
                                    </li>
                                </ul>
                            </h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row bg-primary text-white rounded-3 text-center">
            <h3>Managing Contents</h3>
        </div>
    </div>
    <div class="row">
        @yield('form')
    </div>
@endsection
