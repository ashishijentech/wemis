<?php

namespace App\Repositories;

use App\Models\GpsData;

class DeviceRepo implements \App\InterFaces\DeviceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function vehicleList()
    {
        $vehicles = \App\Models\MapDeviceDetails::with('barcodes')
            ->where('mapDevice_id', auth('api')->id())
            ->get();
        return $vehicles;
    }

    public function getCurrentData($vehicalNo)
    {
        $data = GpsData::select('id', 'latitude', 'longitude', 'speed', 'ignitionStatus', 'headDegree', 'mainsPowerStatus', 'created_at')
            ->where('IMEINumber', $vehicalNo)
            ->latest('created_at')
            ->first();
        return $data;
    }



    public function getPreviousDiffStateId($vehicalNo, $ignition, $speed, $status)
    {
        return GpsData::where('IMEINumber', $vehicalNo)
            ->where(function ($query) use ($ignition, $speed, $status) {
                $query->where('ignitionStatus', '!=', $ignition)
                    ->orWhere(function ($sub) use ($speed, $status) {
                        if ($status === 'Idle') {
                            $sub->where('speed', '!=', 0);
                        } elseif ($status === 'Moving') {
                            $sub->where('speed', 0);
                        } elseif ($status === 'Parking') {
                            $sub->where('speed', '>', 0);
                        }
                    });
            })
            ->orderByDesc('created_at')
            ->value('id');
    }

    /**
     * Get first record of current state after last state change
     */
    public function getStartStateRecord($vehicalNo, $prevDiffStateId = 0)
    {
        return GpsData::select('created_at')
            ->where('IMEINumber', $vehicalNo)
            ->where('id', '>', $prevDiffStateId)
            ->orderBy('created_at', 'asc')
            ->first();
    }



    public function getTodayTravelDistance($vehicalNo)
    {
        $lastPoint = null;
        $distance = 0;

        GpsData::select('latitude', 'longitude', 'created_at')
            ->where('IMEINumber', $vehicalNo)
            ->whereDate('created_at', now()->toDateString())
            ->orderBy('created_at', 'asc')
            ->chunk(1000, function ($chunk) use (&$lastPoint, &$distance) {
                foreach ($chunk as $item) {
                    if ($lastPoint) {
                        if ($lastPoint->latitude != $item->latitude || $lastPoint->longitude != $item->longitude) {
                            $distance += $this->haversineGreatCircleDistance(
                                $lastPoint->latitude,
                                $lastPoint->longitude,
                                $item->latitude,
                                $item->longitude
                            );
                        }
                    }
                    $lastPoint = $item;
                }
            });

        return round($distance, 2); // in KM
    }


    /** * Calculate Haversine Distance in KM */
    private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }


    public function routePlayBack($imeiNo, $startDate = null, $endDate = null)
    {
        // Default to today if no dates are provided
        $startDate = $startDate ?? today()->startOfDay();
        $endDate   = $endDate   ?? today()->endOfDay();

        $records = GpsData::where('IMEINumber', $imeiNo)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at')
            ->get([
                'latitude',
                'longitude',
                'speed',
                'ignitionStatus',
                'headDegree',
                'mainsPowerStatus',
                'created_at'
            ]);

        return [
            'imeiNo'  => $imeiNo,
            'from'    => $startDate,
            'to'      => $endDate,
            'records' => $records,
        ];
    }


    public function geofences($imeiNo)
    {
        return \App\Models\Geofence::where('imeiNumber', $imeiNo)->get();
    }


    function haversine($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // in KM
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // km
    }
}
