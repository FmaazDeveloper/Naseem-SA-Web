@extends('admins.administrative_regions.main')

@section('form')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>
                            Create Region
                            <a href="{{ route('regions.index',$administrative_region_region) }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">
                        <form method="post" action="{{ route('regions.store') }}" enctype="multipart/form-data">

                            @csrf

                            <div class="mb-3">
                                <label for="administrative_region_id" class="form-label">Select administrative region</label>
                                <select class="form-select" name="administrative_region_id" aria-label="Default select example"
                                    id="administrative_region_id">
                                    <option selected disabled>Select administrative_region</option>
                                    @foreach ($administrative_regions as $administrative_region)
                                        <option value="{{ $administrative_region->id }}" @selected($administrative_region->id == $administrative_region_region->id)>
                                            {{ $administrative_region->id . ' - ' . $administrative_region->name }}</option>
                                    @endforeach
                                </select>
                                @error('administrative_region_id')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" name="type" value="City" type="radio"
                                            id="city">
                                        <label class="form-check-label" for="city">
                                            City
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" name="type" value="Island" type="radio"
                                            id="island">
                                        <label class="form-check-label" for="island">
                                            Island
                                        </label>
                                    </div>
                                </div>
                            </div>

                            @error('type')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" value="{{ old('name') }}" class="form-control"
                                    id="name">
                                @error('name')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="main_description">Main description</label>
                                <textarea name="main_description" class="form-control" id="main_description">{{ old('main_description') }}</textarea>
                                @error('main_description')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="weather_description">Weather description</label>
                                <textarea name="weather_description" class="form-control" id="weather_description">{{ old('weather_description') }}</textarea>
                                @error('weather_description')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="card_description" class="form-label">Card description</label>
                                <input name="card_description" type="text" value="{{ old('card_description') }}"
                                    class="form-control" id="card_description" aria-describedby="emailHelp">
                                @error('card_description')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="card_photo" class="form-label">Card photo</label>
                                <input class="form-control" name="card_photo" type="file" id="card_photo" accept="image/png">
                                @error('card_photo')
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
