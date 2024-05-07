@extends('layouts.app')
@section('title', 'Trips')

@section('content')
<div class="py-5">
    <div class="container py-1">
        @include('response')
    </div>
    <div class="container py-5">
        <button class="btn fs-4" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fa-solid fa-circle-plus"></i>
            <span class="fw-semibold">Add trip</span>
        </button>
        @if($trips->isEmpty())
        <div class="fw-2 fs-3 text-muted text-center">
            You don't have any trips yet.
        </div>
        @else
    </div>
    <div class="container py-2">
        @foreach($trips as $trip)
        <div class="card mb-3" style="border: solid 1px rgb(232,232,232)">
            <div class="row ">
                <div class="col-md-9">
                    <div class="card-body">
                        <a href="{{ route('trip.show', ['tripId' => $trip->id]) }}" class="card-title fs-3 mb-3"
                            style="text-decoration: none;">{{ $trip->name }}</a>
                        <div class="card-text">
                            <span class="fs-5">{{ $trip->destination }}</span><br>
                            <small class="text-muted">{{ $trip->start }} to {{ $trip->end }}</small>
                            @php
                                $today = new DateTime(date("Y-m-d"));
                                $startDateTime = new DateTime($trip->start);
                                $daysDifference = $today->diff($startDateTime)->days;
                            @endphp
                            @if($daysDifference == 0)
                                <span class="text-muted"><i>&lpar;today&rpar;</i></span>
                            @elseif($daysDifference < 0)
                                <span class="text-muted"><i>&lpar;done&rpar;</i></span>
                            @else
                                <span class="text-muted"><i>&lpar;in {{ $daysDifference }} day{{ $daysDifference != 1 ? 's' : '' }}&rpar;</i></span>
                            @endif
                        </div>
                        <div class="card-text row mt-4">
                            <a href="{{ route('trip.show', ['tripId' => $trip->id]) }}" class="col-md-2" type="button"
                                style="text-decoration: none; color: inherit">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span class="fw-semibold">Edit trip</span>
                            </a>
                            <div class="col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $trip->id }}">
                                <i class="fa-regular fa-trash-can"></i>
                                <span class="fw-semibold">Delete trip</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="https://media.self.com/photos/5f0885ffef7a10ffa6640daa/4:3/w_2560%2Cc_limit/travel_plane_corona.jpeg"
                        class="img-fluid rounded-end" />
                </div>
            </div>
        </div>

        <!-- Delete Trip Modal -->
        <div class="modal" id="deleteModal{{ $trip->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Delete Trip</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this trip?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('trip.delete', $trip->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
<!-- Add Trip Modal -->
<div class="modal" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Trip</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('trip.add') }}">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Destination</label>
                        <input type="text" class="form-control" name="destination">
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label">Start</label>
                            <input type="date" class="form-control" name="start" min="{{ date("Y-m-d") }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End</label>
                            <input type="date" class="form-control" name="end" min="{{ date("Y-m-d") }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection