<?php

namespace App\Services;

use App\InterFaces\DeviceInterface;
use Illuminate\Support\Carbon;

class DeviceService
{
    private $deviceInterface;

    public function __construct(DeviceInterface $deviceInterface)
    {
        $this->deviceInterface = $deviceInterface;
    }

    public function vehicalList()
    {
        $vehicles = $this->deviceInterface->vehicleList();
       /* $result = [];

        foreach ($vehicles as $vehicle) {
            $imeiNo = $vehicle->barcodes->IMEINO ; // adjust based on your column
           
            $currentData = $this->deviceInterface->getCurrentData($imeiNo);
            $todayDistance = $this->deviceInterface->getTodayTravelDistance($imeiNo);

            $result[] = [
                'vehicle' => $vehicle,
                'current_data' => $currentData,
                'today_distance' => $todayDistance,
            ];
        }
     */

        return $vehicles;
    }

    public function vehicalMap($vehicalNo)
    {
        $currentStatus = $this->deviceInterface->getCurrentData($vehicalNo);

        if (!$currentStatus) {
            return response()->json(['message' => 'Data not found for the provided vehicle number'], 404);
        }

        $ignition = (int) $currentStatus->ignitionStatus;
        $speed    = (float) $currentStatus->speed;

        // Determine status
        if ($ignition === 1 && $speed === 0.0) {
            $status = 'Idle';
        } elseif ($ignition === 1 && $speed > 0) {
            $status = 'Moving';
        } elseif ($ignition === 0) {
            $status = 'Parking';
        } else {
            $status = 'Unknown';
        }

        $prevDiffStateId = $this->deviceInterface->getPreviousDiffStateId($vehicalNo, $ignition, $speed, $status);
        $startStateRecord = $this->deviceInterface->getStartStateRecord($vehicalNo, $prevDiffStateId ?? 0);

        $startTime = $startStateRecord
            ? Carbon::parse($startStateRecord->created_at)
            : Carbon::parse($currentStatus->created_at);

        $now = Carbon::parse($currentStatus->created_at);

        $duration = $startTime->diffForHumans($now);

        // ✅ Get today's travel distance
        $todayTravel = $this->deviceInterface->getTodayTravelDistance($vehicalNo);

        return response()->json([
            'latitude'       => $currentStatus->latitude,
            'longitude'      => $currentStatus->longitude,
            'speed'          => $speed,
            'ignitionStatus' => $ignition,
            'status'         => $status,
            'headDegree'     => $currentStatus->headDegree,
            'mainsPowerStatus' => $currentStatus->mainsPowerStatus,
            'duration'       => $duration,
            'todayTravelKm'  => $todayTravel,
        ]);
    }

    public function matrixView()
    {
        $vehicles = $this->deviceInterface->vehicleList();
        $result = [];

        foreach ($vehicles as $vehicle) {
            $imeiNo    = $vehicle->barcodes->IMEINO ?? null;
            $vehicleNo = $vehicle->vehicle_registration_number ?? null;

            if (!$imeiNo) {
                continue;
            }

            $current     = $this->deviceInterface->getCurrentData($imeiNo);
            $status      = 'Inactive';
            $lastUpdated = null;

            if ($current) {
                $ignition   = (int) $current->ignitionStatus;
                $speed      = (float) $current->speed;
                $lastTime   = Carbon::parse($current->created_at);
                $lastUpdated = $lastTime->diffForHumans();

                if ($lastTime->diffInMinutes(now()) > config('vehicle.offline_threshold', 30)) {
                    $status = 'Out of Network';
                } elseif ($ignition === 0) {
                    $status = 'Parking';
                } elseif ($ignition === 1 && $speed == 0.0) {
                    $status = 'Idle';
                } elseif ($ignition === 1 && $speed > 0) {
                    $status = 'Running';
                }
            }

            $todayTravel = $this->deviceInterface->getTodayTravelDistance($imeiNo);

            $result[] = [
                'vehicleNo'     => $vehicleNo,
                'IMEI'          => $imeiNo,
                'currentData'   => $current ? [
                    'latitude'  => $current->latitude,
                    'longitude' => $current->longitude,
                    'speed'     => $current->speed,
                    'ignition'  => $current->ignitionStatus,
                    'head'      => $current->headDegree,
                    'time'      => $current->created_at,
                ] : null,
                'status'        => $status,
                'todayTravelKm' => $todayTravel,
                'lastUpdated'   => $lastUpdated,
            ];
        }

        return response()->json($result);
    }

    public function routePlayBack($imeiNo)
    {
        $data =  $this->deviceInterface->routePlayBack($imeiNo);
        $records = $data['records'];
        return response()->json($records);
    }

       public function stopage($imeiNo)
    {
        $data = $this->deviceInterface->routePlayBack($imeiNo);
        $stoppages = [];
        $isStopped = false;
        $stopStart = null;
        $stopLat = null;
        $stopLng = null;

        $records = $data['records'];  // this is the Eloquent Collection

        foreach ($records as $record) {
           $record->speed;  // access model property 
        
             if ($record->speed == 0) {
                 if (!$isStopped) {
                     $isStopped = true;
                     $stopStart = $record->created_at;
                     $stopLat = $record->latitude;
                     $stopLng = $record->longitude;
                 }
             } elseif ($isStopped) {
                 $stopEnd = $record->created_at;
                 $duration = $stopEnd->diffInSeconds($stopStart);

                 $stoppages[] = [
                    'start_time'      => $stopStart->toDateTimeString(),
                    'end_time'        => $stopEnd->toDateTimeString(),
                    'duration_seconds' => $duration,
                     'duration_human'  => gmdate('H:i:s', $duration),
                      'latitude'        => $stopLat,
                     'longitude'       => $stopLng,
                 ];

                 $isStopped = false;
             }
        }

         if ($isStopped && $stopStart) {
             $stopEnd = now();
             $duration = $stopEnd->diffInSeconds($stopStart);

             $stoppages[] = [
                 'start_time'      => $stopStart->toDateTimeString(),
                 'end_time'        => $stopEnd->toDateTimeString(),
                 'duration_seconds' => $duration,
                 'duration_human'  => gmdate('H:i:s', $duration),
                 'latitude'        => $stopLat,
                 'longitude'       => $stopLng,
             ];
          }

         return response()->json($stoppages);
    }



    public function overSpeed($imeiNo)
    {
        $records = collect($this->deviceInterface->routePlayBack($imeiNo));
        $overspeeds = [];
        $speedLimit = 30; // Default speed limit

        foreach ($records['records'] as $record) {
            if ((int) $record->speed > $speedLimit) {
                $overspeeds[] = [
                    'time'      => \Carbon\Carbon::parse($record->created_at)->toDateTimeString(),
                    'speed'     => $record->speed,
                    'latitude'  => $record->latitude,
                    'longitude' => $record->longitude,
                ];
            }
        }

        return $overspeeds;
    }


    public function checkGeofence($lat, $lng, $imeiNo)
    {
        $geofences = $this->deviceInterface->geofences($imeiNo); // Fetch all geofences from DB
        $results = [];

        foreach ($geofences as $geofence) {
            $inside = false;

            if ($geofence->type === 'circle') {
                $inside = $this->isInsideCircle(
                    $lat,
                    $lng,
                    $geofence->center_lat,
                    $geofence->center_lng,
                    $geofence->radius
                );
            } elseif ($geofence->type === 'polygon' && $geofence->coordinates) {
                $inside = $this->isInsidePolygon(
                    $lat,
                    $lng,
                    $geofence->coordinates
                );
            }

            $results[] = [
                'geofence' => $geofence->name,
                'inside'   => $inside,
            ];
        }

        return $results;
    }

    private function isInsideCircle($lat, $lng, $centerLat, $centerLng, $radius)
    {
        $earthRadius = 6371000; // meters

        $latFrom = deg2rad($lat);
        $lngFrom = deg2rad($lng);
        $latTo = deg2rad($centerLat);
        $lngTo = deg2rad($centerLng);

        $latDelta = $latTo - $latFrom;
        $lngDelta = $lngTo - $lngFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lngDelta / 2), 2)));

        $distance = $earthRadius * $angle;

        return $distance <= $radius;
    }

    private function isInsidePolygon($lat, $lng, array $polygon)
    {
        $inside = false;
        $j = count($polygon) - 1;

        for ($i = 0; $i < count($polygon); $i++) {
            $xi = $polygon[$i][0];
            $yi = $polygon[$i][1];
            $xj = $polygon[$j][0];
            $yj = $polygon[$j][1];

            $intersect = (($yi > $lng) != ($yj > $lng)) &&
                ($lat < ($xj - $xi) * ($lng - $yi) / ($yj - $yi) + $xi);

            if ($intersect) {
                $inside = !$inside;
            }
            $j = $i;
        }

        return $inside;
    }

    public function sosAlert($imeiNo)
    {
        $records = collect($this->deviceInterface->routePlayBack($imeiNo));
        $sosAlerts = [];

        foreach ($records as $record) {
            if (isset($record->status) && stripos($record->status, 'sos') !== false) {
                $sosAlerts[] = [
                    'time'      => \Carbon\Carbon::parse($record->created_at)->toDateTimeString(),
                    'latitude'  => $record->latitude,
                    'longitude' => $record->longitude,
                ];
            }
        }

        return response()->json($sosAlerts);
    }
}

