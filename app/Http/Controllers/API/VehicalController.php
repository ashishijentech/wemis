<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DeviceService;
use App\Models\MapDeviceDetails;
use App\Models\Geofence;
use App\Models\BarCode;
use Carbon\Carbon;
use App\Models\GpsData;

class VehicalController extends Controller
{
    /**
     * Helper: Determine vehicle status & duration
     */
    private $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }


    /**
     * Vehicle list
     */
    public function vehicleList(Request $request)
    {
        $vehicles = $this->deviceService->vehicalList();
        return  response()->json($vehicles);
    }



    public function vehicalMap($vehicalNo)
    {
        return $this->deviceService->vehicalMap($vehicalNo);
    }

    public function matrixView()
    {
        return $this->deviceService->matrixView();
    }


    /**
     * Route playback for today
     */
    public function routePlayBack($imeiNo)
    {
        return $this->deviceService->routePlayBack($imeiNo);
    }

    /**
     * Stopage report for today
     */
    public function stopage($imeiNo)
    {
        return $this->deviceService->stopage($imeiNo);
    }

    /**
     * Overspeed report for today
     */
    public function overSpeed($imeiNo)
    {
        return response()->json($this->deviceService->overSpeed($imeiNo));
    }

    public function checkGeofence(Request $request, $imeiNo)
    {
        $request->validate([
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $lat = $request->input('latitude');
        $lng = $request->input('longitude');

        return response()->json($this->deviceService->checkGeofence($lat, $lng, $imeiNo));
    }

    public function sosAlert($imeiNo)
    {
        return $this->deviceService->sosAlert($imeiNo);
    }

    public function setGeoFence(Request $request)
    {
        $request->validate([
            'imeiNo' => 'required|string',
        ]);
        $barcode = BarCode::where('IMEINO', $request->imeiNo)->first();
        if (!$barcode) {
            return response()->json(['message' => 'Device not found'], 404);
        }
        $barcodeId = $barcode->id;
        $device =  MapDeviceDetails::where('device_seriel_no', $barcodeId)->first();
        $id = $device->id;
        if (!$id) {
            return response()->json('divice not found!');
            # code...
        }
        $geofences = new Geofence();
        $geofences->map_device_details_id = $id;
        $geofences->type = $request->type;
        $geofences->center_latitude = $request->center_latitude;
        $geofences->center_longitude =   $request->center_longitude;
        $geofences->radius = $request->radius;
        $geofences->coordinates = json_encode($request->coordinates);
        $geofences->save();
        return response()->json('GeoFence set successfully');
    }

    public function getGeoFence($imeiNo)
    {
        $barcode = BarCode::where('IMEINO', $imeiNo)->first();
        if (!$barcode) {
            return response()->json(['message' => 'Device not found'], 404);
        }
        $barcodeId = $barcode->id;
        $device =  MapDeviceDetails::where('device_seriel_no', $barcodeId)->first();
        $id = $device->id;
        $geofences = Geofence::where('map_device_details_id', $id)->get();
        return response()->json($geofences);
    }

    public function getGeoFenceAll()
    {
        $vehicles = $this->deviceService->vehicalList();
        $result = [];

        foreach ($vehicles as $vehicle) {
            $result[] = [
                'vehicle'   => $vehicle,
                'geofences' => Geofence::where('map_device_details_id', $vehicle->id)->get(),
            ];
        }

        return $result;
    }

    public function tripReport($imei, $from, $to)
    {


        $gpsData = GpsData::where('IMEINumber', $imei)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get();

        $trips = [];
        $trip = null;
        $lastPoint = null;

        foreach ($gpsData as $data) {
            if ($data->ignitionStatus == 'ON' && !$trip) {
                // Start new trip
                $trip = [
                    'start_time'   => $data->created_at,
                    'start_lat'    => $data->latitude,
                    'start_lng'    => $data->longitude,
                    'end_time'     => null,
                    'end_lat'      => null,
                    'end_lng'      => null,
                    'distance_km'  => 0,
                    'max_speed'    => $data->speed,
                    'avg_speed'    => 0,
                    'imei'         => $imei,
                ];
            }

            if ($trip) {
                // Track trip metrics
                if ($lastPoint) {
                    $trip['distance_km'] += $this->haversine(
                        $lastPoint->latitude,
                        $lastPoint->longitude,
                        $data->latitude,
                        $data->longitude
                    );
                }
                $trip['max_speed'] = max($trip['max_speed'], $data->speed);
            }

            if ($data->ignitionStatus == 'OFF' && $trip) {
                // End trip
                $trip['end_time'] = $data->created_at;
                $trip['end_lat']  = $data->latitude;
                $trip['end_lng']  = $data->longitude;

                $durationHrs = max(1, Carbon::parse($trip['start_time'])->diffInMinutes($trip['end_time']) / 60);
                $trip['avg_speed'] = $trip['distance_km'] / $durationHrs;

                $trips[] = $trip;
                $trip = null;
            }

            $lastPoint = $data;
        }

        return $trips;
    }


    public function getDistanceReport($imei, $from, $to)
    {
        $gpsData = GpsData::where('IMEINumber', $imei)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get();

        $totalDistance = 0;
        $lastPoint = null;

        foreach ($gpsData as $data) {
            if ($lastPoint) {
                $totalDistance += $this->haversine(
                    $lastPoint->latitude,
                    $lastPoint->longitude,
                    $data->latitude,
                    $data->longitude
                );
            }
            $lastPoint = $data;
        }

        return [
            'imei'          => $imei,
            'from'          => $from,
            'to'            => $to,
            'total_distance_km' => round($totalDistance, 2),
        ];
    }


    public function getIgnitionReport($imei, $from, $to)
    {
        $gpsData = GpsData::where('IMEINumber', $imei)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get();

        $report = [];
        $lastStatus = null;
        $lastTime   = null;

        foreach ($gpsData as $row) {
            $currentStatus = $row->ignitionStatus == 1; // ON = 1, OFF = 0

            if ($lastStatus === null) {
                $lastStatus = $currentStatus;
                $lastTime   = $row->created_at;
                continue;
            }

            if ($currentStatus !== $lastStatus) {
                // Ignition changed (ON → OFF or OFF → ON)
                $report[] = [
                    'imei'       => $imei,
                    'status'     => $lastStatus ? 'ON' : 'OFF',
                    'start_time' => $lastTime,
                    'end_time'   => $row->created_at,
                    'duration'   => Carbon::parse($lastTime)
                        ->diff(Carbon::parse($row->created_at))
                        ->format('%H:%I:%S'),
                ];

                // Reset to new status
                $lastStatus = $currentStatus;
                $lastTime   = $row->created_at;
            }
        }

        // Save last session if still open
        if ($lastStatus !== null && $lastTime !== null) {
            $report[] = [
                'imei'       => $imei,
                'status'     => $lastStatus ? 'ON' : 'OFF',
                'start_time' => $lastTime,
                'end_time'   => $gpsData->last()->created_at,
                'duration'   => Carbon::parse($lastTime)
                    ->diff(Carbon::parse($gpsData->last()->created_at))
                    ->format('%H:%I:%S'),
            ];
        }

        return $report;
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


    public function getIdleReport($imei, $from, $to, $idleSpeed = 2)
    {
        $gpsData = GpsData::where('IMEINumber', $imei)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get();

        $report = [];
        $idleStart = null;

        foreach ($gpsData as $row) {
            $isIdle = ($row->ignitionStatus == 1 && (float)$row->speed <= $idleSpeed);

            if ($isIdle && $idleStart === null) {
                // Idle started
                $idleStart = $row->created_at;
            }

            if ((!$isIdle && $idleStart !== null) || ($isIdle && $row->is($gpsData->last()))) {
                // Idle ended OR last record
                $endTime = $row->created_at;
                $duration = Carbon::parse($idleStart)->diff(Carbon::parse($endTime))->format('%H:%I:%S');

                // Ignore very short idles (< 1 min for example)
                if (Carbon::parse($idleStart)->diffInSeconds(Carbon::parse($endTime)) > 60) {
                    $report[] = [
                        'imei'       => $imei,
                        'start_time' => $idleStart,
                        'end_time'   => $endTime,
                        'duration'   => $duration,
                    ];
                }

                $idleStart = null;
            }
        }

        return $report;
    }



    public function getMovingReport($imei, $from, $to, $minSpeed = 2)
    {
        $gpsData = GpsData::where('IMEINumber', $imei)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get();

        $report = [];
        $movingStart = null;

        foreach ($gpsData as $row) {
            $isMoving = ($row->ignitionStatus == 1 && (float)$row->speed > $minSpeed);

            if ($isMoving && $movingStart === null) {
                // Moving started
                $movingStart = $row->created_at;
            }

            if ((!$isMoving && $movingStart !== null) || ($isMoving && $row->is($gpsData->last()))) {
                // Moving ended OR last record
                $endTime = $row->created_at;
                $duration = Carbon::parse($movingStart)->diff(Carbon::parse($endTime))->format('%H:%I:%S');

                // Ignore very short trips (< 1 min for example)
                if (Carbon::parse($movingStart)->diffInSeconds(Carbon::parse($endTime)) > 60) {
                    $report[] = [
                        'imei'       => $imei,
                        'start_time' => $movingStart,
                        'end_time'   => $endTime,
                        'duration'   => $duration,
                    ];
                }

                $movingStart = null;
            }
        }

        return $report;
    }


    public function getParkingReport($imei, $from, $to)
    {
        $gpsData = GpsData::where('IMEINumber', $imei)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get();

        $report = [];
        $parkingStart = null;

        foreach ($gpsData as $row) {
            $isParking = ($row->ignitionStatus == 0 && (float)$row->speed <= 2);

            if ($isParking && $parkingStart === null) {
                // Parking started
                $parkingStart = $row->created_at;
            }

            if ((!$isParking && $parkingStart !== null) || ($isParking && $row->is($gpsData->last()))) {
                // Parking ended OR last record
                $endTime = $row->created_at;
                $durationSeconds = Carbon::parse($parkingStart)->diffInSeconds(Carbon::parse($endTime));

                if ($durationSeconds > 60) { // ignore very short stops
                    $report[] = [
                        'imei'       => $imei,
                        'start_time' => $parkingStart,
                        'end_time'   => $endTime,
                        'duration'   => gmdate('H:i:s', $durationSeconds),
                    ];
                }

                $parkingStart = null;
            }
        }

        return $report;
    }
}
