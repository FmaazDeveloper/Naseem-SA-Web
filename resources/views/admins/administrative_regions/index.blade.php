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
                            Administrative regions
                        </h4>
                    </div>
                    <div class="card-body m-3">

                        <table class="table table-hover table-bordered table-striped text-center rounded">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($administrative_regions as $administrative_region)
                                    <tr>
                                        <td>{{ $administrative_region->id }}</td>
                                        <td>{{ $administrative_region->name }}</td>
                                        <td><img src="{{ asset($administrative_region->photo) }}" class="rounded w-auto"
                                                alt="{{ $administrative_region->photo }}" width="75" height="75"></td>
                                        <td>
                                            <ol>
                                                @foreach ($administrative_region->regions as $region)
                                                    <li>{{ $region->name }}</li>
                                                @endforeach
                                            </ol>
                                        </td>
                                        <td>{{ $administrative_region->is_active ? 'True' : 'False' }}</td>
                                        <td>
                                            <small>
                                                <p>{{ 'Created : ' . $administrative_region->created_at }}</p>
                                                <p>{{ 'Updated : ' . $administrative_region->updated_at }}</p>
                                            </small>
                                        </td>
                                        <td>
                                            <a href="{{ route('regions.index', $administrative_region->id) }}" class="btn btn-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('administrative_regions.edit', $administrative_region->id) }}" class="btn btn-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center">
                            {{ $administrative_regions->links() }}
                        </div>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <b>
                            Administrative regions : {{ $administrative_regions->count() }} | Regions : {{ $regions->count() }} | Landmarks : {{ $landmarks->count() }}
                            | Activities : {{ $activities->count() }}
                        </b>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
