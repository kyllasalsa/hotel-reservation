<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Http;

class RoomController extends Controller
{
    public function index()
    {
        return Room::all();
    }

    public function show($id)
    {
        try {
            return Room::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'room_number' => 'required|unique:rooms',
                'type' => 'required',
                'price' => 'required',
                'available' => 'required'
            ]);
            $room = Room::create($validated);
            return response()->json($room, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Data tidak valid!',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $room = Room::findOrFail($id);
            $room->update($request->all());
            return $room;
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
            $room = Room::findOrFail($id);
            $room->delete();
            return response()->json(['message' => 'Room deleted']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function bookingsByRoom($room_id)
    {
        try {
            $room = Room::findOrFail($room_id);

            $response = Http::get('http://localhost:8003/api/bookings');
            $bookings = $response->json();

            $roomBooked = collect($bookings)->where('room_id', $room->id)->values();
            $result = [
                'id' => $room->id,
                'room_number' => $room->room_number,
                'type' => $room->type,
                'price' => $room->price,
                'bookings' => $roomBooked,
            ];

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
