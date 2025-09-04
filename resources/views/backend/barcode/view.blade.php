@extends('layouts.manufacturer')
@section('content')
    <div class="container-fluid px-4">

        {{-- Page Header --}}
        <div class="row align-items-center py-3 mb-4"
            style="background: linear-gradient(135deg, #260950 0%, #4B0082 100%); border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
            <div class="col-md-8">
                <h4 class="text-white fw-bold mb-0 d-flex align-items-center">
                    <i class="fas fa-barcode me-2"></i> Barcode Management
                </h4>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <a href="{{ url()->previous() }}" class="btn btn-light fw-semibold shadow-sm d-flex align-items-center">
                    <i class="fas fa-arrow-left me-2"></i> Back
                </a>
            </div>
        </div>

        {{-- Barcode & Serial Info --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="card-title text-primary fw-bold mb-3">
                    {{ $data['manufacturer'][0]['businees_name'] }}
                </h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <span class="fw-semibold text-secondary">Serial No:</span>
                        <div class="text-dark">{{ $data['serialNumber'] }}</div>
                    </div>
                    <div class="col-md-6">
                        <span class="fw-semibold text-secondary">Barcode:</span>
                        <div class="badge bg-dark text-white fs-6">{{ $data['barcodeNo'] }}</div>
                    </div>
                    <div class="col-md-6">
                        <span class="fw-semibold text-secondary">IMEI:</span>
                        <div class="text-dark">{{ $data['IMEINO'] }}</div>
                    </div>
                    <div class="col-md-6">
                        <span class="fw-semibold text-secondary">Batch No:</span>
                        <div class="text-dark">{{ $data['batchNo'] }}</div>
                    </div>
                    <div class="col-md-6">
                        <span class="fw-semibold text-secondary">Status:</span>
                        <div>
                            <span class="badge {{ $data['status'] == 2 ? 'bg-success' : 'bg-danger' }}">
                                {{ $data['status'] == 2 ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Manufacturer Info --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light fw-bold">
                <i class="fas fa-industry me-2 text-primary"></i> Manufacturer Details
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6"><strong>Name:</strong> {{ $data['manufacturer'][0]['name'] }}</div>
                    <div class="col-md-6"><strong>Mobile:</strong> {{ $data['manufacturer'][0]['mobile_no'] }}</div>
                    <div class="col-md-6"><strong>Email:</strong> {{ $data['manufacturer'][0]['email'] }}</div>
                    <div class="col-md-6"><strong>GST No:</strong> {{ $data['manufacturer'][0]['gst_no'] }}</div>
                    <div class="col-12"><strong>Address:</strong> {{ $data['manufacturer'][0]['address'] }}</div>
                </div>
            </div>
        </div>

        {{-- Product Info --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light fw-bold">
                <i class="fas fa-box me-2 text-primary"></i> Product Details
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6"><strong>Element:</strong> {{ $data['element'][0]['name'] }}</div>
                    <div class="col-md-6"><strong>Type:</strong> {{ $data->elementType->pluck('type')->first() }}</div>
                    <div class="col-md-6">
                        <strong>Model:</strong>
                        {{ $data->modelNo->pluck('model_no')->first() }} ,
                        Voltage: {{ $data['modelNo']->pluck('voltage')->first() }}
                    </div>
                    <div class="col-md-6"><strong>Part No:</strong> {{ $data->partNo->pluck('part_no')->first() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
