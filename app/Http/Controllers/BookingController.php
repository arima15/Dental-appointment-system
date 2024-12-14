<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'service' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
        ]);

        // Convert time from 12-hour format to 24-hour format
        $time = date("H:i:s", strtotime($request->time));

        // Get the service name from the Service model
        $service = Service::findOrFail($request->service);
        
        // Create the booking with service name
        Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'service' => $service->name, // Store the service name only
            'date' => $request->date,
            'time' => $time,
            'status' => 'pending'
        ]);

        return response()->json(['success' => true]);
    }

    public function showPending()
    {
        $bookings = Booking::all(); // Fetch all bookings
        return view('dash.pending.pending', compact('bookings')); // Pass bookings to the view
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id); // Fetch the booking by ID
        return view('dash.pending.show', compact('booking')); // Pass booking to the confirmation view
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id); // Fetch the booking by ID
        $booking->delete(); // Delete the booking

        return response()->json(['success' => true]); // Return a success response
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id); // Fetch the booking by ID
        $services = Service::all(); // Fetch all services for the dropdown
        return view('dash.pending.edit', compact('booking', 'services')); // Pass booking and services to the edit view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|in:pending,approved,cancelled'
        ]);

        // Get the service name
        $service = Service::findOrFail($request->service);
        
        // Find the booking and update it
        $booking = Booking::findOrFail($id);
        $booking->update([
            'service' => $service->name, // Store only the service name
            'date' => $request->date,
            'time' => $request->time,
            'status' => $request->status
        ]);

        return response()->json(['success' => true]);
    }
}
