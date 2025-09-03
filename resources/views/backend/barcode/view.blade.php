@extends('layouts.manufacturer')
@section('content')
    <div class="container-fluid px-4">
        <div class="row align-items-center py-3 mb-4"
            style="background: linear-gradient(135deg, #260950 0%, #260950 100%); border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <h4 class="text-white mb-0 px-3 py-2 fw-bold">
                        <i class="fas fa-barcode me-2"></i>
                        Barcode Management
                    </h4>
                    <span class="badge bg-light text-dark ms-2"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-end pe-3">
                    <a class="btn btn-theme t d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        <i class="fas fa-plus-circle me-2"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow p-3 mb-4">
        <h5 class="card-title text-primary">{{ $data['manufacturer'][0]['businees_name'] }}</h5>
        <p><strong>Serial No:</strong> {{ $data['serialNumber'] }}</p>
        <p><strong>Barcode:</strong> {{ $data['barcodeNo'] }}</p>
        <p><strong>IMEI:</strong> {{ $data['IMEINO'] }}</p>
        <p><strong>Batch No:</strong> {{ $data['batchNo'] }}</p>
        <p><strong>Status:</strong> {{ $data['status'] == 2 ? 'Active' : 'Inactive' }}</p>

        <hr>

        <h6>Manufacturer Details</h6>
        <p><strong>Name:</strong> {{ $data['manufacturer'][0]['name'] }}</p>
        <p><strong>Mobile:</strong> {{ $data['manufacturer'][0]['mobile_no'] }}</p>
        <p><strong>Email:</strong> {{ $data['manufacturer'][0]['email'] }}</p>
        <p><strong>GST No:</strong> {{ $data['manufacturer'][0]['gst_no'] }}</p>
        <p><strong>Address:</strong> {{ $data['manufacturer'][0]['address'] }}</p>

        <hr>

        <h6>Product Details</h6>
        <p><strong>Element:</strong> {{ $data['element'][0]['name'] }}</p>
        <p><strong>Type:</strong> {{ $data->elementType->pluck('type')->first()}}</p>
        <p><strong>Model:</strong> {{ $data->modelNo->pluck('model_no')->first()}} ,Voltage: {{ $data['modelNo']->pluck('voltage')->first() }}
        </p>
        <p><strong>Part No:</strong> {{ $data->partNo->pluck('part_no')->first()}}</p>
    </div>
@endsection
