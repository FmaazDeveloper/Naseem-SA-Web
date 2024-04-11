@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('landmarks.update', $landmark->id) }}"  enctype="multipart/form-data">
        <div class="row col-6 m-5 p-3 mb-3 bg-light shadow rounded">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="region" class="form-label">Select region</label>
                <select class="form-select" name="region_id" aria-label="Default select example" id="region">
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" @selected($landmark->region->id == $region->id)>
                            {{ $region->id . ' - ' . $region->name }}</option>
                    @endforeach
                </select>
                @error('region')
                    <small style="color: red">*{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input name="name" type="text" value="{{ $landmark->name }}" class="form-control" id="name">
                @error('name')
                    <small style="color: red">*{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description">{{ $landmark->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input name="location" type="text" value="{{ $landmark->location }}" class="form-control" id="location">
                @error('location')
                    <small style="color: red">*{{ $message }}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input class="form-control" name="photo" type="file" id="photo" accept="image/png">
                        @error('photo')
                            <small style="color: red">*{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <img src="{{ asset($landmark->photo) }}" class="rounded" alt="{{ $landmark->photo }}"
                    height="100">
                </div>
            </div>
            <div class="mb-3 form-check">
                <input name="is_active" type="checkbox" value="1" class="form-check-input" id="is_active"
                    @checked($landmark->is_active)>
                <label class="form-check-label" for="is_active">Is active</label>
            </div>

            <button type="submit" class="btn btn-success">Update</button>

        </div>
    </form>
@endsection
