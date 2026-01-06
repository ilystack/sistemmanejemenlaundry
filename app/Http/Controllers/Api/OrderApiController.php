<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\User;
use App\Helpers\DistanceCalculator;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    /**
     * Get all pakets
     */
    public function getPakets()
    {
        $pakets = Paket::all();
        return response()->json($pakets);
    }

    /**
     * Calculate distance from customer to laundry
     */
    public function calculateDistance(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Get admin's laundry coordinates
        $admin = User::where('role', 'admin')->first();

        if (!$admin || !$admin->latitude || !$admin->longitude) {
            return response()->json([
                'success' => false,
                'message' => 'Lokasi laundry belum ditentukan oleh admin. Silakan hubungi admin.'
            ], 400);
        }

        // Calculate distance using Haversine
        $distance = DistanceCalculator::haversine(
            $request->latitude,
            $request->longitude,
            $admin->latitude,
            $admin->longitude
        );

        // Calculate delivery fee
        $fee = DistanceCalculator::calculateDeliveryFee($distance);

        return response()->json([
            'success' => true,
            'distance' => $distance,
            'fee' => $fee,
            'laundry_location' => [
                'latitude' => $admin->latitude,
                'longitude' => $admin->longitude,
            ]
        ]);
    }
}
