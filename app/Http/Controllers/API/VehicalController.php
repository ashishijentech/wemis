<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DeviceService;
use App\Models\MapDeviceDetails;
use App\Models\Geofence;
use App\Models\BarCode;

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
}
