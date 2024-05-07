@extends('layouts.app')
@section('title', 'Trip Details')

@section('content')
<div class="py-5">
    <div class="container py-5">
        @include('response')
        <span class="fs-2 fw-semibold">Trip Details</span>
    </div>
    <div class="container py-2">
        <form action="{{ route('trip.update', $trip->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-5">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" value="{{ old('name', $trip->name) }}" name="tname">
                </div>
                <div class="col-5">
                    <label class="form-label">Destination</label>
                    <input type="text" class="form-control" value="{{ old('destination', $trip->destination) }}"
                        name="tdest">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-5">
                    <label class="form-label">Start</label>
                    <input type="date" class="form-control" value="{{ old('start', $trip->start) }}" min="{{ date("Y-m-d") }}" name="tstart">
                </div>
                <div class="col-5">
                    <label class="form-label">End</label>
                    <input type="date" class="form-control" value="{{ old('end', $trip->end) }}" name="tend">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
        <div class="mt-4">
            <ul class="nav nav-pills">
                <li class="mx-2">
                    <a data-toggle="pill" href="#flight" role="button"
                        class="btn btn-outline-primary btn-lg btn-iconed btn-rounded">
                        <i class="fa fa-solid fa-plane-up"></i> <span class="spn">Flights</span>
                    </a>
                </li>
                <li class="mx-2">
                    <a data-toggle="pill" href="#activity" role="button"
                        class="btn btn-outline-primary btn-lg btn-iconed btn-rounded">
                        <i class="fa fa-solid fa-mountain-city"></i> <span class="spn">Activities</span>
                    </a>
                </li>
                <li class="mx-2">
                    <a data-toggle="pill" href="#lodge" role="button"
                        class="btn btn-outline-primary btn-lg btn-iconed btn-rounded">
                        <i class="fa fa-solid fa-hotel"></i> <span class="spn">Lodges</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-3">
            <!-- Flights Tab -->
            <div id="flight" class="tab-pane">
                <button class="btn fs-5" data-bs-toggle="modal" data-bs-target="#addFlightModal">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span class="fw-semibold">Add</span>
                </button>
                @if ($trip->flights->isEmpty())
                <p class="fw-semibold fs-5 text-muted text-center">No flights associated with this trip.</p>
                @else
                <table class="table table-hover mb-3">
                    <thead>
                        <tr>
                            <th scope="col">Flight Number</th>
                            <th scope="col">Airline</th>
                            <th scope="col">Departure</th>
                            <th scope="col">Arrival</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trip->flights as $flight)
                        <tr>
                            <td>{{ $flight->flight_number }}</td>
                            <td>{{ $flight->airline }}</td>
                            <td>{{ date('d-m H:i', strtotime($flight->departure)) }}</td>
                            <td>{{ date('d-m H:i', strtotime($flight->arrival)) }}</td>
                            <td>
                                <div class=row>
                                    <div class="col-md-4" type="button" data-bs-toggle="modal"
                                        data-bs-target="#editFlightModal{{ $flight->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span class="fw-semibold">Edit</span>
                                    </div>
                                    <div class="col-md-4" type="button" data-bs-toggle="modal"
                                        data-bs-target="#deleteFlightModal">
                                        <i class="fa-regular fa-trash-can"></i>
                                        <span class="fw-semibold">Delete</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Edit Flight Modal -->
                        <div class="modal" id="editFlightModal{{ $flight->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Edit Flight</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST"
                                        action="{{ route('trip.updateFlight', ['tripId' => $trip->id, 'flightId' => $flight->id]) }}">
                                        <div class="modal-body">


                                            @csrf
                                            @method('PUT')

                                            <div class="mb-2">
                                                <label class="form-label">Flight Number</label>
                                                <input type="text" class="form-control" name="fnumber"
                                                    value="{{ old('flight_number', $flight->flight_number) }}">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Airline</label>
                                                <input type="text" class="form-control" name="fairline"
                                                    value="{{ old('airline', $flight->airline) }}">
                                            </div>
                                            <div class="row mb-2 align-items-center">
                                                <div class="col-md-6">
                                                    <label class="form-label">Departure</label>
                                                    <input type="datetime" class="form-control" name="fdep"
                                                        value="{{ old('departure', $flight->departure) }}"
                                                        min="{{ $trip->start }}" max="{{ $trip->end }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Arrival</label>
                                                    <input type="datetime" class="form-control" name="farr"
                                                        value="{{ old('arrival', $flight->arrival) }}"
                                                        min="{{ $trip->start }}" max="{{ $trip->end }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Flight Modal -->
                        <div class="modal" id="deleteFlightModal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Delete Trip</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this flight permenantly?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <form
                                            action="{{ route('trip.deleteFlight', ['tripId' => $trip->id, 'flightId' => $flight->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            <!-- Activities Tab -->
            <div id="activity" class="tab-pane">
                <button class="btn fs-5" data-bs-toggle="modal" data-bs-target="#addActivityModal">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span class="fw-semibold">Add</span>
                </button>
                @if ($trip->activities->isEmpty())
                <p class="fw-semibold fs-5 text-muted text-center">No activities associated with this trip.</p>
                @else
                @foreach ($trip->activities as $activity)
                <div class="card mb-3">
                    <div class="card-header fw-semibold text-muted">
                        {{ date('D, d M', strtotime($activity->date)) }}
                    </div>
                    <div class="card-body row fs-6">
                        <div class="col-md-3 fw-semibold text-muted">
                            12:00 PM
                        </div>
                        <div class="col-md-3 fw-bold">
                            {{ $activity->name }}
                        </div>
                        <div class="col-md-3">
                            <i class="fa-solid fa-location-dot"></i> {{ $activity->address }}
                        </div>
                        <div class="col-md-3">
                            <div class=row>
                                <div class="col-md-4" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#editActivity{{ $activity->id }}" aria-expanded="false"
                                    aria-controls="editActivity{{ $activity->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span class="fw-semibold">Edit</span>
                                </div>
                                <div class="col-md-4" type="button" data-bs-toggle="modal"
                                    data-bs-target="#deleteActivityModal{{ $activity->id }}">
                                    <i class="fa-regular fa-trash-can"></i>
                                    <span class="fw-semibold">Delete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Activity Toggle -->
                    <div class="collapse" id="editActivity{{ $activity->id }}">
                        <div class="card card-body">
                            <form method="POST"
                                action="{{ route('trip.updateActivity', ['tripId' => $trip->id, 'activityId' => $activity->id]) }}">

                                @csrf
                                @method('PUT')

                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="actname"
                                            value="{{ old('name', $activity->name) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Location</label>
                                        <input type="text" class="form-control" name="actaddress"
                                            value="{{ old('address', $activity->address) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control" name="actdate"
                                            value="{{ old('date', $activity->date) }}" min="{{ $trip->start }}"
                                            max="{{ $trip->end }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label style="display: none" class="form-label"></label><br>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Delete Activity Modal -->
                <div class="modal" id="deleteActivityModal{{ $activity->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Delete Activity</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this activity permenantly?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form
                                    action="{{ route('trip.deleteActivity', ['tripId' => $trip->id, 'activityId' => $activity->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <!-- Lodges Tab -->
            <div id="lodge" class="tab-pane">
                <button class="btn fs-5" data-bs-toggle="modal" data-bs-target="#addLodgeModal">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span class="fw-semibold">Add</span>
                </button>
                @if ($trip->lodges->isEmpty())
                <p class="fw-semibold fs-5 text-muted text-center">No lodges associated with this trip.</p>
                @else
                @foreach ($trip->lodges as $lodge)
                <div class="card mb-3">
                    <div class="card-header fw-semibold text-muted">
                        {{ date('D, d M', strtotime($lodge->check_in)) }} – {{ date('D, d M', strtotime($lodge->check_out)) }}
                    </div>
                    <div class="card-body row fs-6">
                        <div class="col-md-4 fw-bold">
                            {{ $lodge->name }}
                        </div>
                        <div class="col-md-5">
                            <i class="fa-solid fa-location-dot"></i> {{ $lodge->address }}
                        </div>
                        <div class="col-md-3">
                            <div class=row>
                                <div class="col-md-4" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#editLodge{{ $lodge->id }}" aria-expanded="false"
                                    aria-controls="editLodge{{ $lodge->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span class="fw-semibold">Edit</span>
                                </div>
                                <div class="col-md-4" type="button" data-bs-toggle="modal"
                                    data-bs-target="#deleteLodgeModal{{ $lodge->id }}">
                                    <i class="fa-regular fa-trash-can"></i>
                                    <span class="fw-semibold">Delete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Lodge Toggle -->
                    <div class="collapse" id="editLodge{{ $lodge->id }}">
                        <div class="card card-body">
                            <form form method="POST"
                                action="{{ route('trip.updateLodge', ['tripId' => $trip->id, 'lodgeId' => $lodge->id]) }}">

                                @csrf
                                @method('PUT')

                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="lodname"
                                            value="{{ old('name', $lodge->name) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="lodaddress"
                                            value="{{ old('address', $lodge->address) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Check-in</label>
                                        <input type="date" class="form-control" name="lodcheckin"
                                            value="{{ old('check_in', $lodge->check_in) }}" min="{{ $trip->start }}"
                                            max="{{ $trip->end }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Check-out</label>
                                        <input type="date" class="form-control" name="lodcheckout"
                                            value="{{ old('check_out', $lodge->check_out) }}" min="{{ $trip->start }}"
                                            max="{{ $trip->end }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label style="display: none" class="form-label"></label><br>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Delete Lodge Modal -->
                <div class="modal" id="deleteLodgeModal{{ $lodge->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Delete Lodge</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this lodge permenantly?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form
                                    action="{{ route('trip.deleteLodge', ['tripId' => $trip->id, 'lodgeId' => $lodge->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Add Flight Modal -->
<div class="modal" id="addFlightModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Flight</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('trip.addFlight', ['tripId' => $trip->id]) }}">
                <div class="modal-body">

                    @csrf
                    @method('POST')

                    <div class="mb-2">
                        <label class="form-label">Flight Number</label>
                        <input type="text" class="form-control" name="fnumber">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Airline</label>
                        <input type="text" class="form-control" name="fairline">
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-6">
                            <label class="form-label">Departure</label>
                            <input type="date" class="form-control" name="fdep" min="{{ $trip->start }}" 
                                max="{{ $trip->end }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Arrival</label>
                            <input type="date" class="form-control" name="farr" min="{{ $trip->start }}"
                                max="{{ $trip->end }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Activity Modal -->
<div class="modal" id="addActivityModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Activity</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('trip.addActivity', ['tripId' => $trip->id]) }}">
                <div class="modal-body">

                    @csrf
                    @method('POST')

                    <div class="mb-2">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="actname">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" name="actaddress">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="actdate" min="{{ $trip->start }}"
                            max="{{ $trip->end }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Lodge Modal -->
<div class="modal" id="addLodgeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Lodge</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form form method="POST" action="{{ route('trip.addLodge', ['tripId' => $trip->id]) }}">
                <div class="modal-body">

                    @csrf
                    @method('POST')

                    <div class="mb-2">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="lodname">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="lodaddress">
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-6">
                            <label class="form-label">Check-in</label>
                            <input type="date" class="form-control" name="lodcheckin" min="{{ $trip->start }}"
                                max="{{ $trip->end }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Check-out</label>
                            <input type="date" class="form-control" name="lodcheckout" min="{{ $trip->start }}"
                                max="{{ $trip->end }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection