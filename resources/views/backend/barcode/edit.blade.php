@extends('layouts.manufacturer')
@section('content')
<div class="container-fluid px-4">

    <!-- Header -->
    <div class="row align-items-center py-3 mb-4"
        style="background: linear-gradient(135deg, #260950 0%, #4a148c 100%); border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
        <div class="col-md-8">
            <div class="d-flex align-items-center">
                <h4 class="text-white mb-0 px-3 py-2 fw-bold">
                    <i class="fas fa-barcode me-2"></i> Edit Barcode
                </h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex justify-content-end pe-3">
                <a class="btn btn-light d-flex align-items-center rounded-pill px-3" href="">
                    <i class="fas fa-arrow-left me-2"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
    <form action="" method="post" id="creationForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Device Information -->
        <div class="card mb-4 border-0 shadow-sm rounded-3">
            <div class="card-header bg-light fw-semibold">
                <i class="fas fa-microchip me-2"></i> Device Information
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!-- Element -->
                    <div class="col-md-6">
                        <label class="form-label">Select Element <span class="text-danger">*</span></label>
                        <select name="element" class="form-select element @error('element') is-invalid @enderror">
                            <option value="" disabled>Select Element</option>
                            @foreach ($element as $item)
                                <option value="{{ $item->element_id }}" @selected($barcode->element_id == $item->element_id)>
                                    {{ $item->element->pluck('name')->first() }}
                                </option>
                            @endforeach
                        </select>
                        @error('element')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Type -->
                    <div class="col-md-6">
                        <label class="form-label">Select Type <span class="text-danger">*</span></label>
                        <select name="element_type" class="form-select element_type @error('element_type') is-invalid @enderror">
                            <option value="" disabled>Select Type</option>
                        </select>
                        @error('element_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Model -->
                    <div class="col-md-6">
                        <label class="form-label">Select Model No <span class="text-danger">*</span></label>
                        <select name="model_no" class="form-select model-no @error('model_no') is-invalid @enderror">
                            <option value="" disabled>Select Model</option>
                        </select>
                        @error('model_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Part -->
                    <div class="col-md-6">
                        <label class="form-label">Device Part No <span class="text-danger">*</span></label>
                        <select name="device_part_no" class="form-select partNo @error('device_part_no') is-invalid @enderror">
                            <option value="" disabled>Select Part No</option>
                        </select>
                        @error('device_part_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Technical Specs -->
        <div class="card mb-4 border-0 shadow-sm rounded-3">
            <div class="card-header bg-light fw-semibold">
                <i class="fas fa-cogs me-2"></i> Technical Specifications
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">TAC No</label>
                        <select name="tacNo" class="form-select tacNo @error('tacNo') is-invalid @enderror"></select>
                        @error('tacNo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">COP No</label>
                        <select name="copNo" class="form-select copNo @error('copNo') is-invalid @enderror"></select>
                        @error('copNo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">COP Valid Till</label>
                        <input type="date" name="copValidTill" class="form-control copValidTill"
                               value="{{ $barcode->cop_valid_till }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Testing Agency</label>
                        <select name="testingAgency" class="form-select testingAgency"></select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Voltage</label>
                        <select name="voltage" class="form-select voltage"></select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Batch No</label>
                        <input type="text" name="batchNo" class="form-control" value="{{ $barcode->batchNo }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Barcode No <span class="text-danger">*</span></label>
                        <input type="text" name="barcodeNo" class="form-control" value="{{ $barcode->barcodeNo }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional -->
        <div class="card mb-4 border-0 shadow-sm rounded-3">
            <div class="card-header bg-light fw-semibold">
                <i class="fas fa-info-circle me-2"></i> Additional Details
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Is Renew</label>
                        <select name="is_renew" class="form-select">
                            <option value="1" @selected($barcode->is_renew == '1')>No</option>
                            <option value="0" @selected($barcode->is_renew == '0')>Yes</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Device Serial No <span class="text-danger">*</span></label>
                        <input type="text" name="serialNo" class="form-control" value="{{ $barcode->serialNumber }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- SIM Details -->
        <div id="simDetails"></div>

        <!-- Actions -->
        <div class="d-flex justify-content-end mt-4">
            <a href="" class="btn btn-outline-secondary rounded-pill px-4 me-2">
                <i class="fas fa-times me-2"></i> Cancel
            </a>
            <button type="submit" class="btn rounded-pill px-4" style="background: linear-gradient(135deg,#260950,#4a148c); color:#fff;">
                <i class="fas fa-save me-2"></i> Update Barcode
            </button>
        </div>
    </form>
</div>

{{-- Script --}}
<script>
window.preselected = {
    element: "{{ $barcode->element_id ?? '' }}",
    element_type: "{{ $barcode->type_id ?? '' }}",
    model_no: "{{ $barcode->model_id ?? '' }}",
    part_no: "{{ $barcode->part_id ?? '' }}",
    tac_no: "{{ $barcode->tac_id ?? '' }}",
    cop_no: "{{ $barcode->cop_id ?? '' }}",
    testing_agency: "{{ $barcode->testing_agencyId ?? '' }}",
    voltage: "{{ $barcode->voltage_id ?? '' }}",
    sims: @json($barcode->sim ?? [])
};

$(document).ready(function () {
    // SIM fields
    function generateSimFields(sims = []) {
        let container = $('#simDetails');
        container.empty();
        sims.forEach((sim, i) => {
            container.append(`
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white fw-semibold">
                        <i class="fas fa-sim-card me-2"></i> SIM ${i + 1} Details
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">SIM Number</label>
                                <input type="text" name="sim[${i}][number]" value="${sim.simNo ?? ''}" class="form-control" placeholder="Enter SIM No">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ICCID</label>
                                <input type="text" name="sim[${i}][iccid]" value="${sim.ICCIDNo ?? ''}" class="form-control" placeholder="Enter ICCID">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Operator</label>
                                <input type="text" name="sim[${i}][operator]" value="${sim.operator ?? ''}" class="form-control" placeholder="Operator Name">
                            </div>
                        </div>
                    </div>
                </div>
            `);
        });
    }

    // Dropdown chaining (Element → Type → Model → Part → TAC → COP → Agency)
    $('.element').on('change', function() {
        const id = $(this).val();
        $('.element_type').html('<option>Loading...</option>');
        if (id) {
            $.get(`/manufacturer/fetch/element-type/${id}`, res => {
                $('.element_type').html('<option value="">Select Type</option>');
                res.forEach(item => $('.element_type').append(`<option value="${item.id}">${item.type}</option>`));
                if (window.preselected.element_type) {
                    $('.element_type').val(window.preselected.element_type).trigger('change');
                    window.preselected.element_type = null;
                }
            });
        }
    });

    $('.element_type').on('change', function() {
        const id = $(this).val();
        $('.model-no').html('<option>Loading...</option>');
        if (id) {
            $.get(`/manufacturer/fetch/model-no/${id}`, res => {
                $('.model-no').html('<option value="">Select Model</option>');
                res.forEach(item => $('.model-no').append(`<option value="${item.id}">${item.model_no}</option>`));
                if (window.preselected.model_no) {
                    $('.model-no').val(window.preselected.model_no).trigger('change');
                    window.preselected.model_no = null;
                }
            });
        }
    });

    $('.model-no').on('change', function() {
        const id = $(this).val();
        $('.partNo').html('<option>Loading...</option>');
        if (id) {
            $.get(`/manufacturer/fetch/part-no/${id}`, res => {
                $('.partNo').html('<option value="">Select Part</option>');
                res.forEach(item => $('.partNo').append(`<option value="${item.id}">${item.part_no}</option>`));
                if (window.preselected.part_no) {
                    $('.partNo').val(window.preselected.part_no).trigger('change');
                    window.preselected.part_no = null;
                }
            });
        }
    });

    $('.partNo').on('change', function() {
        const id = $(this).val();
        $('.tacNo').html('<option>Loading...</option>');
        if (id) {
            $.get(`/manufacturer/fetch/tac-no/${id}`, res => {
                $('.tacNo').html('<option value="">Select TAC</option>');
                res.forEach(item => $('.tacNo').append(`<option value="${item.id}">${item.tacNo}</option>`));
                if (window.preselected.tac_no) {
                    $('.tacNo').val(window.preselected.tac_no).trigger('change');
                    window.preselected.tac_no = null;
                }
            });
        }
    });

    $('.tacNo').on('change', function() {
        const id = $(this).val();
        $('.copNo').html('<option>Loading...</option>');
        if (id) {
            $.get(`/manufacturer/fetch/cop-no/${id}`, res => {
                $('.copNo').html('<option value="">Select COP</option>');
                res.forEach(item => $('.copNo').append(`<option value="${item.id}">${item.COPNo}</option>`));
                if (window.preselected.cop_no) {
                    $('.copNo').val(window.preselected.cop_no).trigger('change');
                    window.preselected.cop_no = null;
                }
            });
        }
    });

    $('.copNo').on('change', function() {
        const id = $(this).val();
        $('.testingAgency').html('<option>Loading...</option>');
        if (id) {
            $.get(`/manufacturer/fetch/testing-agency/${id}`, res => {
                $('.testingAgency').html('<option value="">Select Agency</option>');
                res.forEach(item => $('.testingAgency').append(`<option value="${item.id}">${item.testingAgency}</option>`));
                if (window.preselected.testing_agency) {
                    $('.testingAgency').val(window.preselected.testing_agency);
                    window.preselected.testing_agency = null;
                }
            });
        }
    });

    // Initial selections
    if (window.preselected.element) {
        $('.element').val(window.preselected.element).trigger('change');
    }

    // Render SIMs
    if (window.preselected.sims.length > 0) {
        generateSimFields(window.preselected.sims);
    }
});
</script>
@endsection
