@extends('admins.administrative_regions.main')

@section('form')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    @if (session('msg'))
                        <div class="text-center alert alert-success">{{ session('msg') }}</div>
                    @endif
                    <div class="card-header">
                        <h4>
                            Activities
                            <a href="{{ route('activities.create', $landmark->id) }}" class="btn btn-success float-end">Add
                                Activity</a>
                            <a href="{{ route('landmarks.index', $landmark->region->id) }}"
                                class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">

                        <table class="table table-hover table-bordered table-striped text-center rounded">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Landmark</th>
                                    <th scope="col">Activity description</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($landmark->activities as $activity)
                                    <tr>
                                        <td>{{ $activity->id }}</td>
                                        <td>{{ $activity->landmark->name }}</td>
                                        <td>{{ $activity->description }}</td>
                                        <td><img src="{{ asset($activity->photo) }}" class="rounded"
                                                alt="{{ $landmark->photo }}" width="75" height="75">
                                        </td>
                                        <td>{{ $activity->is_active ? 'True' : 'False' }}</td>
                                        <td>
                                            <small>
                                                <p>{{ 'Created : ' . $activity->created_at }}</p>
                                                <p>{{ 'Updated : ' . $activity->updated_at }}</p>
                                            </small>
                                        </td>
                                        <td>
                                            <a href="{{ route('activities.edit', $activity->id) }}"
                                                class="btn btn-warning m-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                            </a>
                                            <form method="post" action="{{ route('activities.destroy', $activity->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure to delete Activity ID # {{ $activity->id }}?')"
                                                    class="btn btn-danger m-1">
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
                        <div class="pagination justify-content-center">
                            {{ $activities->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
