<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Facades\Validator;
use App\Models\Flight;
use App\Models\Activity;
use App\Models\Lodge;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TripController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = Auth::user();
            $trips = Trip::where('user_id', $user->id)->get();
            return view('trips.index', compact('trips'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function show($tripId)
    {
        $trip = Trip::with('flights', 'activities', 'lodges')->find($tripId);
        return view('trips.show', compact('trip'));
    }

    public function create(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string',
                'destination' => 'required|string',
                'start' => 'required',
                'end' => 'required',
            ]);

            if (!(Carbon::parse($validated['start']) <= Carbon::parse($validated['end']))) {
                return redirect()->back()->with('error', 'Please enter valid dates');
            }
            $trip = new Trip();
            $trip->name = $validated['name'];
            $trip->destination = $validated['destination'];
            $trip->start = $validated['start'];
            $trip->end = $validated['end'];
            $trip->user_id = Auth::user()->id;
            $trip->save();

            return redirect()->route('trip.index')->with('success', 'Trip created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function update(Request $request, $tripId)
    {
        try {
            $trip = Trip::findOrFail($tripId);

            if (!empty($request->tname)) {
                $trip->name = $request->tname;
            }

            if (!empty($request->tdest)) {
                $trip->destination = $request->tdest;
            }

            if (!empty($request->tstart)) {
                $trip->start = $request->tstart;
            }

            if (!empty($request->tend)) {
                $trip->end = $request->tend;
            }

            $trip->save();
            return redirect()->route('trip.show', $trip->id)->with('success', 'Trip updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function delete(Trip $trip)
    {
        try {

            $trip = Trip::findOrFail($trip->id);
            $trip->delete();
            return redirect()->route('trip.index')->with('success', 'Trip deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    // Flights
    public function createFlight(Request $request, $tripId)
    {
        try {

            $validated = $request->validate([
                'fnumber' => 'required|string',
                'fairline' => 'required|string',
                'fdep' => 'required',
                'farr' => 'required',
            ]);

            if (!(Carbon::parse($validated['fdep']) < Carbon::parse($validated['farr']))) {
                return redirect()->back()->with('error', 'Please enter valid dates');
            }
            $flight = new Flight();
            $flight->flight_number = $validated['fnumber'];
            $flight->airline = $validated['fairline'];
            $flight->departure = $validated['fdep'];
            $flight->arrival = $validated['farr'];
            $flight->trip_id = $tripId;
            $flight->save();

            return redirect()->route('trip.show', $tripId)->with('success', 'Flight added successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
    public function updateFlight(Request $request, $tripId, $flightId)
    {
        try {
            $flight = Flight::findOrFail($flightId);

            if (!empty($request->fnumber)) {
                $flight->flight_number = $request->fnumber;
            }

            if (!empty($request->fairline)) {
                $flight->airline = $request->fairline;
            }

            if (!empty($request->fdep)) {
                $flight->departure = $request->fdep;
            }

            if (!empty($request->farr)) {
                $flight->arrival = $request->farr;
            }

            $flight->save();
            return redirect()->route('trip.show', $flight->trip_id)->with('success', 'Flight updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function deleteFlight($tripId, $flightId)
    {
        try {
            $flight = Flight::findOrFail($flightId);
            $flight->delete();

            return redirect()->route('trip.show', $tripId)->with('success', 'Flight deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // Activities
    public function createActivity(Request $request, $tripId)
    {
        try {

            $validated = $request->validate([
                'actname' => 'required|string',
                'actaddress' => 'required|string',
                'actdate' => 'required',
            ]);

            $activity = new Activity();
            $activity->name = $validated['actname'];
            $activity->address = $validated['actaddress'];
            $activity->date = $validated['actdate'];
            $activity->trip_id = $tripId;
            $activity->save();

            return redirect()->route('trip.show', $tripId)->with('success', 'Activity added successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
    public function updateActivity(Request $request, $tripId, $activityId)
    {
        try {
            $activity = Activity::findOrFail($activityId);

            if (!empty($request->actname)) {
                $activity->name = $request->actname;
            }
            if (!empty($request->actaddress)) {
                $activity->address = $request->actaddress;
            }
            if (!empty($request->actdate)) {
                $activity->date = $request->actdate;
            }

            $activity->save();
            return redirect()->route('trip.show', $activity->trip_id)->with('success', 'Activity updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function deleteActivity($tripId, $activityId)
    {
        try {
            $activity = Activity::findOrFail($activityId);
            $activity->delete();

            return redirect()->route('trip.show', $tripId)->with('success', 'Activity deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // Lodges
    public function createLodge(Request $request, $tripId)
    {
        try {

            $validated = $request->validate([
                'lodname' => 'required|string',
                'lodaddress' => 'required|string',
                'lodcheckin' => 'required',
                'lodcheckout' => 'required',
            ]);

            $lodge = new Lodge();
            $lodge->name = $validated['lodname'];
            $lodge->address = $validated['lodaddress'];
            $lodge->check_in = $validated['lodcheckin'];
            $lodge->check_out = $validated['lodcheckout'];
            $lodge->trip_id = $tripId;
            $lodge->save();

            return redirect()->route('trip.show', $tripId)->with('success', 'Lodge added successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
    public function updateLodge(Request $request, $tripId, $lodgeId)
    {
        try {
            $lodge = Lodge::findOrFail($lodgeId);

            if (!empty($request->lodname)) {
                $lodge->name = $request->lodname;
            }
            if (!empty($request->lodaddress)) {
                $lodge->address = $request->lodaddress;
            }
            if (!empty($request->lodcheckin)) {
                $lodge->check_in = $request->lodcheckin;
            }
            if (!empty($request->lodcheckout)) {
                $lodge->check_out = $request->lodcheckout;
            }

            $lodge->save();
            return redirect()->route('trip.show', $lodge->trip_id)->with('success', 'Lodge updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteLodge($tripId, $lodgeId)
    {
        try {
            $lodge = Lodge::findOrFail($lodgeId);
            $lodge->delete();

            return redirect()->route('trip.show', $tripId)->with('success', 'Lodge deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
