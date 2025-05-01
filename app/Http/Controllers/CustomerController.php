<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::all();
    }

    public function show($id)
    {
        try {
            return Customer::findOrFail($id);
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
                'name' => 'required',
                'email' => 'required|email|unique:customers',
                'phone' => 'required'
            ]);
            $customer = Customer::create($validated);
            return response()->json($customer, 201);
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
            $customer = Customer::findOrFail($id);
            $customer->update($request->all());
            return $customer;
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
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return response()->json(['message' => 'Customer deleted']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function bookingsByCustomer($customer_id)
    {
        try {
            $customer = Customer::findOrFail($customer_id);

            $response = Http::get('http://localhost:8003/api/bookings');
            $bookings = $response->json();

            $customerBookings = collect($bookings)->where('customer_id', $customer->id)->values();
            $result = [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'bookings' => $customerBookings,
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
