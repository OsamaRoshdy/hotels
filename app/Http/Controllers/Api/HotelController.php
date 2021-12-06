<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Foundation\Classes\Hotels;
use App\Http\Foundation\Classes\Providers\ProviderA;
use App\Http\Foundation\Classes\Providers\ProviderB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required',
            'to' => 'required',
            'city' => 'required',
            'adults' => 'required',
        ]);
        if ($validator->fails()) {
            return  response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            return  response()->json(['data' => Hotels::getHotels($request)]);
        } catch (\Exception $exception) {
            return  response()->json(['errors' => 'INVALID_REQUEST_SIGNATURE'], 400);
        }
    }
}
