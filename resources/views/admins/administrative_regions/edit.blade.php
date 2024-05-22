@extends('layouts.app')
@section('title')
    Edit
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>
                            Edit Administrative region
                            <a href="{{ route('administrative_regions.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">
                        <form method="post" action="{{ route('administrative_regions.update', $administrativeRegion->id) }}" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" value="{{ $administrativeRegion->name }}" class="form-control"
                                    id="name">
                                @error('name')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Photo</label>
                                        <input class="form-control" name="photo" value="{{ $administrativeRegion->photo }}"
                                            type="file" id="photo" accept="image/*">
                                        @error('photo')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <img src="{{ asset($administrativeRegion->photo) }}" class="rounded"
                                        alt="{{ $administrativeRegion->photo }}" height="100">
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input name="is_active" type="checkbox" value="1" class="form-check-input"
                                    id="is_active" @checked($administrativeRegion->is_active)>
                                <label class="form-check-label" for="is_active">Is active</label>
                                @error('is_active')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
