@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>
                            Edit Activity
                            <a href="{{ route('activities.index', $activity->landmark->id) }}"
                                class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">
                        <form method="post" action="{{ route('activities.update', $activity->id) }}" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="administrative_region_id" class="form-label">Administrative region</label>
                                <input type="text"
                                    value="{{ $activity->region->administrative_region->id . ' - ' . $activity->region->administrative_region->name }}"
                                    class="form-control" id="administrative_region_id" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="region_id" class="form-label">Region</label>
                                <input type="text"
                                    value="{{ $activity->landmark->region->id . ' - ' . $activity->landmark->region->name }}"
                                    class="form-control" id="region_id" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="landmark_id" class="form-label">Select landmark</label>
                                <select class="form-select" name="landmark_id" aria-label="Default select example"
                                    id="landmark_id">
                                    @foreach ($activity->landmark->region->landmarks as $landmark)
                                        <option value="{{ $landmark->id }}" @selected($activity->landmark->id == $landmark->id)>
                                            {{ $landmark->id . ' - ' . $landmark->name }}</option>
                                    @endforeach
                                </select>
                                @error('landmark_id')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description">{{ $activity->description }}</textarea>
                                @error('description')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Photo</label>
                                        <input class="form-control" name="photo" type="file" id="photo"
                                            accept="image/png">
                                        @error('photo')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <img src="{{ asset($activity->photo) }}" class="rounded" alt="{{ $activity->photo }}"
                                        height="100">
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input name="is_active" type="checkbox" value="1" class="form-check-input"
                                    id="is_active" @checked($activity->is_active)>
                                <label class="form-check-label" for="is_active">Is active</label>
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
