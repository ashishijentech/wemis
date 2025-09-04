@extends('layouts.manufacturer')
@section('content')
    <div class="container-fluid px-4">

        <!-- Page Header -->
        <div class="row align-items-center py-3 mb-4"
            style="background: linear-gradient(135deg, #260950 0%, #260950 100%); border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div class="col-md-6">
                <h4 class="text-white mb-0 fw-bold">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Monitoring Dashboard
                </h4>
            </div>
        </div>

        <!-- ELEMENT: VLTD -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">
                    <i class="fas fa-microchip me-2"></i> ELEMENTS -
                    <select name="" style="display: inline">
                        @foreach ($element as $item)
                            <option value="{{ $item->id }}">{{ $item->element->pluck('name')->first() }}</option>
                        @endforeach
                    </select>
                </h6>
                <span class="badge bg-primary">Live</span>
            </div>
            <div class="card-body">
                <div class="row g-3">

                    <!-- Total Installed Devices -->
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-server fa-2x text-primary mb-2"></i>
                                <h6 class="fw-bold">Total Installed</h6>
                                <h5 class="text-dark">{{ $totalInstalled ?? 0 }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Total Online Devices -->
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-wifi fa-2x text-success mb-2"></i>
                                <h6 class="fw-bold">Online Devices</h6>
                                <h5 class="text-dark">{{ $totalOnline ?? 0 }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Total Offline Devices -->
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-plug fa-2x text-danger mb-2"></i>
                                <h6 class="fw-bold">Offline Devices</h6>
                                <h5 class="text-dark">{{ $totalOffline ?? 0 }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Lost Devices -->
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marker-alt fa-2x text-warning mb-2"></i>
                                <h6 class="fw-bold">Lost Devices</h6>
                                <h5 class="text-dark">{{ $lostDevices ?? 0 }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Tempered Devices -->
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-tools fa-2x text-danger mb-2"></i>
                                <h6 class="fw-bold">Tempered Devices</h6>
                                <h5 class="text-dark">{{ $temperedDevices ?? 0 }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Battery Disconnect -->
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-battery-empty fa-2x text-danger mb-2"></i>
                                <h6 class="fw-bold">Battery Disconnect</h6>
                                <h5 class="text-dark">{{ $batteryDisconnect ?? 0 }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Parked Devices -->
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-car-side fa-2x text-info mb-2"></i>
                                <h6 class="fw-bold">Parked Devices</h6>
                                <h5 class="text-dark">{{ $parkedDevices ?? 0 }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Over Speed Devices -->
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-tachometer-alt fa-2x text-warning mb-2"></i>
                                <h6 class="fw-bold">Over Speed</h6>
                                <h5 class="text-dark">{{ $overSpeedDevices ?? 0 }}</h5>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
