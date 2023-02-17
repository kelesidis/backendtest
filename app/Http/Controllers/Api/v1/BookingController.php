<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Services\BookingService;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{

public function getBookings(Request $request,BookingService $bookingService)
{
 return $bookingService->getBookings($request);
}

public function bookProduct(Request $request,BookingService $bookingService)
{
    return $bookingService->bookProduct($request);
}
}
