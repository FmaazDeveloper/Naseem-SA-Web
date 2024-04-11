@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('activities.store') }}" enctype="multipart/form-data">
        <div class="row col-6 m-5 p-3 mb-3 bg-light shadow rounded">

            @csrf

            <div class="mb-3">
                <label for="region_id" class="form-label">Region</label>
                <input type="text" value="{{ $landmark_activity->region->id . ' - ' . $landmark_activity->region->name }}"
                    class="form-control" id="region_id" disabled>
            </div>

            <div class="mb-3">
                <label for="landmark_id" class="form-label">Select landmark</label>
                <select class="form-select" name="landmark_id" aria-label="Default select example" id="landmark_id">
                    <option selected>Select region</option>
                    @foreach ($landmarks as $landmark)
                        <option value="{{ $landmark->id }}" @selected($landmark->id == $landmark_activity->id)>
                            {{ $landmark->id . ' - ' . $landmark->name }}</option>
                    @endforeach
                </select>
                @error('landmark_id')
                    <small style="color: red">*{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                @error('description')
                    <small style="color: red">*{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input name="is_active" type="checkbox" value="1" class="form-check-input" id="is_active">
                <label class="form-check-label" for="is_active">Is active</label>
            </div>


            <button type="submit" class="btn btn-success">Create</button>

        </div>
    </form>
@endsection
