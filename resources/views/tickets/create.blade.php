@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    @if (session('msg'))
                        <div class="text-center alert alert-success">{{ session('msg') }}</div>
                    @endif
                    <div class="card-header">
                        <h4>
                            Open Ticket
                        </h4>
                    </div>
                    <div class="card-body m-3">
                        <form method="post" action="{{ route('tickets.store') }}" enctype="multipart/form-data">

                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" value="{{ $user->name }}" id="name" disabled>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" value="{{ $user->email }}" id="email" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="contact_reason_id" class="form-label">Select reason</label>
                                <select class="form-select" name="contact_reason_id" aria-label="Default select example"
                                    id="region">
                                    <option selected disabled>Select reason</option>
                                    @foreach ($contact_reasons as $contact_reason)
                                        <option value="{{ $contact_reason->id }}">
                                            {{ $contact_reason->id . ' - ' . $contact_reason->name }}</option>
                                    @endforeach
                                </select>
                                @error('contact_reason_id')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input name="title" type="text" value="{{ old('title') }}"
                                    class="form-control" id="title">
                                @error('title')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control" id="message">{{ old('message') }}</textarea>
                                @error('message')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="file" class="form-label">File</label>
                                <input class="form-control" name="file" type="file" id="file" accept="image/png,jpeg,pdf">
                                @error('file')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" name="status_id" value="1" class="btn btn-primary">Send</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
