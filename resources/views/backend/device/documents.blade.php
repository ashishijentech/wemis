@extends($layout)
@section('content')
    <div class="conatiner-fluid">
        <div class="align-items-center row"
            style="background: linear-gradient(135deg, #2a0b5a 0%, #1a0638 100%); padding: 12px 20px;box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="me-3 text-white fas fa-map-marked-alt fs-4"></i>
                    <h4 class="mb-0 text-white card-title" style="font-weight: 600; letter-spacing: 0.5px;">Documents
                    </h4>
                </div>
            </div>
        </div>
    </div>
    @php
        $documents = [
            'Vehicle' => $device->vehicle,
            'RC' => $device->rc,
            'Device' => $device->device,
            'PAN' => $device->pan,
            'Aadhaar' => $device->aadhaar,
            'Invoice' => $device->invoice,
            'Signature' => $device->signature,
            'Panic Button' => $device->panic_button,
        ];
    @endphp

    <div class="my-2">
        <div class="row">
            @foreach ($documents as $name => $file)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex align-items-center">
                            <i class="fa fa-file me-2"></i>
                            <h6 class="mb-0">{{ $name }}</h6>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('uploads/' . $file) }}" alt="{{ $name }}"
                                class="img-fluid rounded mb-2" style="max-height:150px;">
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ asset('uploads/' . $file) }}" download class="btn btn-sm btn-primary">
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
