<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Booking;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BookingService{

    public function getBookings($request)
    {
        try {
            $bookings = Booking::with('product')->get();

            $data = $bookings->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'client_id' => $booking->client_id,
                    'product_id' => $booking->product_id,
                    'booked_on' => $booking->booked_on,
                    'is_available' => $booking->product->bookings->count() < $booking->product->capacity ? 'Available' : 'Unavailable',
                ];
            });
            Log::info('search', ['get booking' => $data]);
            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            Log::error('Error while getting bookings: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }


    public function bookProduct($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'client_id' => 'required|exists:clients,id',
                'product_id' => 'required|exists:products,id',
                'booked_on' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first()], 400);
            }

            $clientId = $request->input('client_id');
            $productId = $request->input('product_id');
            $bookedOn = $request->input('booked_on');

            $product = Product::findOrFail($productId);

            if ($product->bookings->count() >= $product->capacity) {
                return response()->json(['message' => 'Product is fully booked'], 400);
            }

            $client = Client::findOrFail($clientId);

            if ($client->bookings()->where('product_id', $productId)->exists()) {
                return response()->json(['message' => 'Client has already booked this product'], 400);
            }

            $booking = new Booking();
            $booking->client_id = $clientId;
            $booking->product_id = $productId;
            $booking->booked_on = $bookedOn;
            $booking->save();

            return response()->json(['message' => 'Booking created successfully'], 201);
        } catch (Exception $e) {
            Log::error('Error while saving bookings: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while creating the booking'], 500);
        }
    }

    }
