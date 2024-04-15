@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>
                            Create Activity
                            <a href="{{ route('activities.index', $landmark_activity) }}"
                                class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">
                        <form method="post" action="{{ route('activities.store') }}">

                            @csrf

                            <div class="mb-3">
                                <label for="region_id" class="form-label">Region</label>
                                <input type="text"
                                    value="{{ $landmark_activity->region->id . ' - ' . $landmark_activity->region->name }}"
                                    class="form-control" id="region_id" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="landmark_id" class="form-label">Select landmark</label>
                                <select class="form-select" name="landmark_id" aria-label="Default select example"
                                    id="landmark_id">
                                    <option selected>Select region</option>
                                    @foreach ($landmark_activity->region->landmarks as $landmark)
                                        <option value="{{ $landmark->id }}" @selected($landmark->id == $landmark_activity->id)>
                                            {{ $landmark->id . ' - ' . $landmark->name }}</option>
                                    @endforeach
                                </select>
                                @error('landmark_id')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input name="is_active" type="checkbox" value="1" class="form-check-input"
                                    id="is_active">
                                <label class="form-check-label" for="is_active">Is active</label>
                                @error('is_active')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Create</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
