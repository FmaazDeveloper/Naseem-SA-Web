@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('activities.update', $activity->id) }}" enctype="multipart/form-data">
        <div class="row col-6 m-5 p-3 mb-3 bg-light shadow rounded">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="region_id" class="form-label">Region</label>
                <input type="text" value="{{ $activity->landmark->region->id . ' - ' . $activity->landmark->region->name }}"
                    class="form-control" id="region_id" disabled>
            </div>

            <div class="mb-3">
                <label for="region" class="form-label">Select landmark</label>
                <select class="form-select" name="landmark_id" aria-label="Default select example" id="region">
                    @foreach ($activity->landmark->region->landmarks as $landmark)
                        <option value="{{ $landmark->id }}" @selected($activity->landmark->id == $landmark->id)>
                            {{ $landmark->id . ' - ' . $landmark->name }}</option>
                    @endforeach
                </select>
                @error('region')
                    <small style="color: red">*{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description">{{ $activity->description }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input name="is_active" type="checkbox" value="1" class="form-check-input" id="is_active"
                    @checked($activity->is_active)>
                <label class="form-check-label" for="is_active">Is active</label>
            </div>

            <button type="submit" class="btn btn-success">Update</button>

        </div>
    </form>
@endsection
