<?php

namespace App\Helpers;

class DistanceCalculator
{
    /**
     * Calculate distance between two coordinates using Haversine formula
     * 
     * @param float $lat1 Latitude point 1
     * @param float $lon1 Longitude point 1
     * @param float $lat2 Latitude point 2
     * @param float $lon2 Longitude point 2
     * @return float Distance in kilometers
     */
    public static function haversine($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius bumi dalam kilometer

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos($latFrom) * cos($latTo) *
            sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return round($distance, 2); // Return dalam km dengan 2 desimal
    }

    /**
     * Calculate delivery fee based on distance
     * 
     * @param float $distance Distance in kilometers
     * @param int $ratePerKm Rate per kilometer (default: 1000)
     * @return int Delivery fee
     */
    public static function calculateDeliveryFee($distance, $ratePerKm = 1000)
    {
        return (int) ceil($distance * $ratePerKm);
    }
}
