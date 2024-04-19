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
                            Regions
                            <a href="{{ route('regions.create',$administrative_region->id) }}" class="btn btn-success float-end">Add Region</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">

                        <table class="table table-hover table-bordered table-striped text-center rounded">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Administrative region</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Card photo</th>
                                    <th scope="col">Landmarks</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($regions as $region)
                                    <tr>
                                        <td>{{ $region->id }}</td>
                                        <td>{{ $region->administrative_region->name }}</td>
                                        <td>{{ $region->type }}</td>
                                        <td>{{ $region->name }}</td>
                                        <td><img src="{{ asset($region->card_photo) }}" class="rounded w-auto"
                                                alt="{{ $region->card_photo }}" width="75" height="75"></td>
                                        <td>
                                            <ol>
                                                @foreach ($region->landmarks as $landmark)
                                                    <li>{{ $landmark->name }}</li>
                                                @endforeach
                                            </ol>
                                        </td>
                                        <td>{{ $region->is_active ? 'True' : 'False' }}</td>
                                        <td>
                                            <small>
                                                <p>{{ 'Created : ' . $region->created_at }}</p>
                                                <p>{{ 'Updated : ' . $region->updated_at }}</p>
                                            </small>
                                        </td>
                                        <td>
                                            <a href="{{ route('landmarks.index', $region->id) }}" class="btn btn-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('regions.edit', $region->id) }}" class="btn btn-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                            </a>
                                            <form style="display: inline" method="post"
                                                action="{{ route('regions.destroy', $region->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure to delete Region ID #  {{ $region->id }}?')"
                                                    class="btn btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                        <path
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <b>
                            Regions : {{ $regions->count() }} | Landmarks : {{ $landmarks->count() }}
                            | Activities : {{ $activities->count() }}
                        </b>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
