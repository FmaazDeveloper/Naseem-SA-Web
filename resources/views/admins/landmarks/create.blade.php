@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>
                            Create Landmark
                            <a href="{{ route('landmarks.index',$landmark->region->id) }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">
                        <form method="post" action="{{ route('landmarks.store') }}">

                            @csrf

                            <div class="mb-3">
                                <label for="region" class="form-label">Select region</label>
                                <select class="form-select" name="region_id" aria-label="Default select example"
                                    id="region">
                                    <option selected disabled>Select region</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}" @selected($region->id == $region_landmark->id)>
                                            {{ $region->id . ' - ' . $region->name }}</option>
                                    @endforeach
                                </select>
                                @error('region')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" value="{{ old('name') }}" class="form-control"
                                    id="name">
                                @error('name')
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
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input name="location" type="text" value="{{ old('location') }}" class="form-control"
                                    id="location">
                                @error('location')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input class="form-control" name="photo" type="file" id="photo" accept="image/png">
                                @error('photo')
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
