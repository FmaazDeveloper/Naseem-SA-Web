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
                            Edit Order
                            <a href="{{ route('orders.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">
                        <form method="post" action="{{ route('orders.update',$order->id) }}" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="tourist_name" class="form-label">Tourist Name</label>
                                        <input type="text" class="form-control" value="{{ $order->tourist->name }}" id="tourist_name" disabled>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="guide_name" class="form-label">Guide Name</label>
                                        <input type="text" class="form-control" value="{{ $order->guide->name }}" id="guide_name" disabled>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="region_name" class="form-label">Region Name</label>
                                        <input type="text" class="form-control" value="{{ $order->region->name }}" id="region_name" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Select status</label>
                                <select class="form-select" name="status" aria-label="Default select example" id="status">
                                        <option value="Actived" @selected($order->status == 'Actived')>Actived</option>
                                        <option value="Pending" @selected($order->status == 'Pending')>Pending</option>
                                        <option value="Completed" @selected($order->status == 'Completed')>Completed</option>
                                        <option value="Canceled" @selected($order->status == 'Canceled')>Canceled</option>
                                        <option value="Rejected" @selected($order->status == 'Rejected')>Rejected</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="number_of_people" class="form-label">Number of people</label>
                                        <input name="number_of_people" type="text"
                                            value="{{ $order->number_of_people }}" class="form-control"
                                            id="number_of_people">
                                        @error('number_of_people')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Start date</label>
                                        <input name="start_date" type="date" value="{{ $order->start_date }}"
                                            class="form-control" id="start_date">
                                        @error('start_date')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End date</label>
                                        <input name="end_date" type="date" value="{{ $order->end_date }}"
                                            class="form-control" id="end_date">
                                        @error('end_date')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
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
