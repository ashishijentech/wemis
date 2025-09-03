<?php

namespace App\InterFaces;

interface DeviceInterface
{
    public function vehicleList();
    public function getCurrentData($vehicalNo);
    public function getPreviousDiffStateId($vehicalNo, $ignition, $speed, $status);
    public function getStartStateRecord($vehicalNo, $prevDiffStateId = 0);

    public function getTodayTravelDistance($imeiNo);
    public function routePlayBack($imeiNo);
    
    public function geofences($imeiNo);
}

