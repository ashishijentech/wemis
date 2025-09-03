@extends($layout)
@section('content')
    <div class="container-fluid">

        <div class="align-items-center row"
            style="background: linear-gradient(135deg, #2a0b5a 0%, #1a0638 100%); padding: 12px 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="me-3 text-white fas fa-map-marked-alt fs-4"></i>
                    <h4 class="mb-0 text-white card-title" style="font-weight: 600; letter-spacing: 0.5px;">Details Map
                        Devices
                    </h4>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-md-end justify-content-sm-start">
                    <a href="" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
                type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Customer Details</button>
            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
                type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Installation
                Detail</button>
            <button class="nav-link" id="v-pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#v-pills-disabled"
                type="button" role="tab" aria-controls="v-pills-disabled" aria-selected="false" disabled>RFC
                Info</button>
            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages"
                type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Device Info</button>
            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings"
                type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">SIM Info</button>
            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings"
                type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Vehicle Info</button>
            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings"
                type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Packages</button>
            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings"
                type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Packages</button>
            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" 
                type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Documents</button>


        </div>
        <div class="tab-content" id="v-pills-tabContent">
            @include('backend.device.partials.tab.customer-info')
            @include('backend.device.partials.tab.installation-detail')
            <div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab"
                tabindex="0">...</div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"
                tabindex="0">...</div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"
                tabindex="0">...</div>
        </div>
    </div>
@endsection
