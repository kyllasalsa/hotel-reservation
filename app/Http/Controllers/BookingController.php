<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{
    public function index()
    {
        return Booking::all();
    }

    public function show($id)
    {
        try {
            $booking = Booking::findOrFail($id);

            $customerResponse = Http::get('http://localhost:8001/api/customers/' . $booking->customer_id);
            if ($customerResponse->failed()) {
                return response()->json(['message' => 'Customer not found'], 404);
            }
            $customer = $customerResponse->json();

            $roomResponse = Http::get('http://localhost:8002/api/rooms/' . $booking->room_id);
            if ($roomResponse->failed()) {
                return response()->json(['message' => 'Room not found'], 404);
            }
            $room = $roomResponse->json();

            return response()->json([
                'id' => $booking->id,
                'check_in_date' => $booking->check_in_date,
                'check_out_date' => $booking->check_out_date,
                'customer' => [
                    'name' => $customer['name'],
                    'email' => $customer['email'],
                    'phone' => $customer['phone'],
                ],
                'room' => [
                    'room_number' => $room['room_number'],
                    'type' => $room['type'],
                    'price' => $room['price'],
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(Request $request)
    {
        $customerResponse = Http::get('http://localhost:8001/api/customers/' . $request->customer_id);
        if ($customerResponse->failed()) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        $customer = $customerResponse->json();

        $roomResponse = Http::get('http://localhost:8002/api/rooms/' . $request->room_id);
        if ($roomResponse->failed()) {
            return response()->json(['message' => 'Room not found'], 404);
        }
        $room = $roomResponse->json();

        if (!$room['available']) {
            return response()->json(['message' => 'Room not available'], 400);
        }

        $booking = Booking::create([
            'customer_id' => $request->customer_id,
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
        ]);

        return response()->json($booking, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->update($request->all());
            return $booking;
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();
            return response()->json(['message' => 'Booking deleted']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
