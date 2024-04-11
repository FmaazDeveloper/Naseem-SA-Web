@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('regions.store') }}" enctype="multipart/form-data">
        <div class="row col-6 m-5 p-3 mb-3 bg-light shadow rounded">

            @csrf

            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" name="type" value="City" type="radio" id="city">
                    <label class="form-check-label" for="city">
                        City
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" name="type" value="Island" type="radio" id="island">
                    <label class="form-check-label" for="island">
                        Island
                    </label>
                </div>
            </div>

            @error('type')
                <small style="color: red">*{{ $message }}</small>
            @enderror

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input name="name" type="text" value="{{ old('name') }}" class="form-control" id="name">
                @error('name')
                    <small style="color: red">*{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="main_description">Main description</label>
                <textarea name="main_description" class="form-control" id="main_description">{{ old('main_description') }}</textarea>
                @error('main_description')
                    <small style="color: red">*{{ $message }}</small>
                @enderror
            </div>


            <div class="mb-3">
                <label for="weather_description">Weather description</label>
                <textarea name="weather_description" class="form-control" id="weather_description">{{ old('weather_description') }}</textarea>
                @error('weather_description')
                    <small style="color: red">*{{ $message }}</small>
                @enderror
            </div>


            <div class="mb-3">
                <label for="card_description" class="form-label">Card description</label>
                <input name="card_description" type="text" value="{{ old('card_description') }}" class="form-control"
                    id="card_description" aria-describedby="emailHelp">
                    @error('card_description')
                        <small style="color: red">*{{ $message }}</small>
                    @enderror
            </div>


            <div class="mb-3">
                <label for="card_photo" class="form-label">Card photo</label>
                <input class="form-control" name="card_photo" type="file" id="card_photo" accept="image/png">
                @error('card_photo')
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
