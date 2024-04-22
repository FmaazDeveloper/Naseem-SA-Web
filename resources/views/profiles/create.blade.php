@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>
                            Update your profile information
                            <a href="{{ route('profiles.index',Auth::user()->id) }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">
                        <form method="post" action="{{ route('profiles.store') }}" enctype="multipart/form-data">

                            @csrf

                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" name="type" value="Male" type="radio"
                                            id="Male">
                                        <label class="form-check-label" for="Male">
                                            Male
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" name="type" value="Female" type="radio"
                                            id="Female">
                                        <label class="form-check-label" for="Female">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone number</label>
                                <input name="phone_number" type="text" value="{{ old('phone_number') }}" class="form-control"
                                    id="phone_number">
                                @error('phone_number')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input name="age" type="text" value="{{ old('age') }}" class="form-control"
                                    id="age">
                                @error('age')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            @error('type')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror

                            <div class="mb-3">
                                <label for="nationality" class="form-label">Nationality</label>
                                <input name="nationality" type="text" value="{{ old('nationality') }}" class="form-control"
                                    id="nationality">
                                @error('nationality')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="language" class="form-label">Language</label>
                                <input name="language" type="text" value="{{ old('language') }}" class="form-control"
                                    id="language">
                                @error('language')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input class="form-control" name="photo" type="file" id="photo" accept="image/png,jpeg">
                                @error('photo')
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
