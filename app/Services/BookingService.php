<?php

namespace App\Services;


use App\Models\Client;
use App\Models\Booking;
use App\Models\Product;

class BookingService{

    public function getBookings($request)
    {
    $bookings = Booking::all();

    $data = [];
    foreach ($bookings as $booking) {
        $product = $booking->product;

        $isAvailable = $product->bookings->count() < $product->capacity;

        $data[] = [
            'id' => $booking->id,
            'client_id' => $booking->client_id,
            'product_id' => $booking->product_id,
            'booked_on' => $booking->booked_on,
            'is_available' => $isAvailable ? 'Available' : 'Unavailable',
        ];
    }

    return response()->json(['data' => $data], 200);

    }

    public function bookProduct($request)
    {
        // dd($request);
        $clientId = $request->input('client_id');
        $productId = $request->input('product_id');
        $bookedOn = $request->input('booked_on');

        // Check if client exists
        $client = Client::find($clientId);
        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        // Check if product exists
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Check if product is already fully booked
        if ($product->bookings->count() >= $product->capacity) {
            return response()->json(['message' => 'Product is fully booked'], 400);
        }

        // Check if client has already booked this product
        if ($client->bookings()->where('product_id', $productId)->exists()) {
            return response()->json(['message' => 'Client has already booked this product'], 400);
        }

        // Create a new booking
        $booking = new Booking();
        $booking->client_id = $clientId;
        $booking->product_id = $productId;
        $booking->booked_on = $bookedOn;
        $booking->save();

        return response()->json(['message' => 'Booking created successfully'], 201);
    }

}
