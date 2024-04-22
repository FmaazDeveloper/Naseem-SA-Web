@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>
                            Update your profile information
                            <a href="{{ route('profiles.index',$user_id) }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">
                        <form method="post" action="{{ route('profiles.update',$profile->user->id) }}" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" name="type" value="Male" type="radio"
                                            id="Male" @checked($profile->gender === 'Male')>
                                        <label class="form-check-label" for="Male">
                                            Male
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" name="type" value="Female" type="radio"
                                            id="Female" @checked($profile->gender === 'Female')>
                                        <label class="form-check-label" for="Female">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('type')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" value="{{ $profile->user->name }}" class="form-control"
                                    id="name">
                                @error('name')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone number</label>
                                <input name="phone_number" type="text" value="{{ $profile->phone_number ? $profile->phone_number : old('phone_number') }}"
                                    class="form-control" id="phone_number">
                                @error('phone_number')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input name="age" type="text" value="{{ $profile->age ? $profile->age : old('age') }}" class="form-control"
                                    id="age">
                                @error('age')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nationality" class="form-label">Nationality</label>
                                <input name="nationality" type="text" value="{{ $profile->nationality ? $profile->nationality : old('nationality') }}"
                                    class="form-control" id="nationality">
                                @error('nationality')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="language" class="form-label">Language</label>
                                <input name="language" type="text" value="{{ $profile->language ? $profile->language : old('language') }}"
                                    class="form-control" id="language">
                                @error('language')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Photo</label>
                                        <input class="form-control" name="photo" value="{{ $profile->photo }}"
                                            type="file" id="photo" accept="image/png,jpeg">
                                        @error('photo')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <img src="{{ asset($profile->photo) }}" class="rounded" alt="{{ $profile->photo }}"
                                        height="100">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
