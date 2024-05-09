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
                            Respond Ticket
                            <a href="{{ route('tickets.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">
                        <form method="post" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" value="{{ $ticket->user->name }}"
                                            id="name" disabled>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" value="{{ $ticket->user->email }}"
                                            id="email" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" value="{{ $ticket->title }}" class="form-control" id="title"
                                    disabled>
                            </div>

                            <div class="mb-3">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" disabled>{{ $ticket->message }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="answer">Answer</label>
                                <textarea name="answer" class="form-control" id="answer">{{ $ticket->answer ?? old('answer') }}</textarea>
                                @error('answer')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="answer_file" class="form-label">File</label>
                                <input class="form-control" name="answer_file" type="file" id="answer_file"
                                    accept="image/png,jpeg,pdf">
                                @error('answer_file')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            @if ($ticket->status !== 'Closed')
                                <button type="submit" name="status" value="Closed" class="btn btn-primary">Send</button>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
