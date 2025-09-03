@extends('layouts.manufacturer')
@section('content')
    <div class="container-fluid px-4">

        <div class="row align-items-center py-3 mb-4"
            style="background: linear-gradient(135deg, #260950 0%, #260950 100%); border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <h4 class="text-white mb-0 px-3 py-2 fw-bold">
                        <i class="fas fa-barcode me-2"></i>
                        Edit Barcode
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

    <div class="container-fluid px-4">
        <form action="{{ route('barcode.store') }}" method="post" id="creationForm" enctype="multipart/form-data">
            @csrf

            <!-- Device Information Section -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-microchip me-2"></i>
                        Device Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Element Selection -->
                        <div class="col-md-6">
                            <label class="form-label">Select Element <span class="text-danger">*</span></label>
                            <select name="element" class="form-select element @error('element') is-invalid @enderror">
                                <option value="" selected disabled>Select Element</option>
                                @foreach ($element as $item)
                                    <option value="{{ $item->element_id }}" @selected(old('element') == $item->element_id)>
                                        {{ $item->element->pluck('name')->first() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('element')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Element Type -->
                        <div class="col-md-6">
                            <label class="form-label">Select Type <span class="text-danger">*</span></label>
                            <select name="element_type"
                                class="form-select element_type @error('element_type') is-invalid @enderror">
                                <option value="" selected disabled>Select Type</option>
                            </select>
                            @error('element_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Model Number -->
                        <div class="col-md-6">
                            <label class="form-label">Select Model No <span class="text-danger">*</span></label>
                            <select name="model_no" class="form-select model-no @error('model_no') is-invalid @enderror">
                                <option value="" selected disabled>Select Model</option>
                            </select>
                            @error('model_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Part Number -->
                        <div class="col-md-6">
                            <label class="form-label">Device Part No <span class="text-danger">*</span></label>
                            <select name="device_part_no"
                                class="form-select partNo @error('device_part_no') is-invalid @enderror">
                                <option value="" selected disabled>Select Part No</option>
                            </select>
                            @error('device_part_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technical Specifications Section -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Technical Specifications
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- TAC No -->
                        <div class="col-md-3">
                            <label class="form-label">TAC No</label>
                            <select name="tacNo" class="form-select tacNo @error('tacNo') is-invalid @enderror">
                                <option value="" selected disabled>Select TAC</option>
                            </select>
                            @error('tacNo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- COP No -->
                        <div class="col-md-3">
                            <label class="form-label">COP No</label>
                            <select name="copNo" class="form-select copNo @error('copNo') is-invalid @enderror">
                                <option value="" selected disabled>Select COP</option>
                            </select>
                            @error('copNo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- COP Valid Till -->
                        <div class="col-md-3">
                            <label class="form-label">COP Valid Till</label>
                            <input type="date" name="copValidTill"
                                class="form-control copValidTill @error('copValidTill') is-invalid @enderror">
                            @error('copValidTill')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Testing Agency -->
                        <div class="col-md-3">
                            <label class="form-label">Testing Agency</label>
                            <select name="testingAgency"
                                class="form-select testingAgency @error('testingAgency') is-invalid @enderror">
                                <option value="" selected disabled>Select Agency</option>
                            </select>
                            @error('testingAgency')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Voltage -->
                        <div class="col-md-3">
                            <label class="form-label">Voltage</label>
                            <select name="voltage" class="form-select voltage @error('voltage') is-invalid @enderror">
                                <option value="" selected disabled>Select Voltage</option>
                            </select>
                            @error('voltage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Batch No -->
                        <div class="col-md-3">
                            <label class="form-label">Batch No</label>
                            <input type="text" name="batchNo" class="form-control @error('batchNo') is-invalid @enderror"
                                value="{{ $batchNo }}">
                            @error('batchNo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Barcode Creation Type -->
                        <div class="col-md-3" id="creationTypeContainer">
                            <label class="form-label">Barcode Creation Type</label>
                            <select class="form-select" id="barCodeCreationType" name="barCodeCreationType">
                                <option value="" selected disabled>Select Type</option>
                                <option value="manual">Manual</option>
                                <option value="import">Import</option>
                            </select>
                        </div>

                        <!-- Barcode No -->
                        <div class="col-md-3" id="barcodeNoBox">
                            <label class="form-label">Barcode No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('barcodeNo') is-invalid @enderror"
                                name="barcodeNo" value="{{ old('barcodeNo') }}">
                            @error('barcodeNo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Details Section -->
            <div class="card mb-4 border-0 shadow-sm" id="bottomRow">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Additional Details
                    </h6>
                </div>
                <div class="card-body" id>
                    <div class="row g-3">
                        <!-- Renew Status -->
                        <div class="col-md-2">
                            <label class="form-label">Is Renew</label>
                            <select name="is_renew" class="form-select @error('is_renew') is-invalid @enderror">
                                <option value="1" @selected(old('is_renew') == '1')>No</option>
                                <option value="0" @selected(old('is_renew') == '0')>Yes</option>
                            </select>
                            @error('is_renew')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Serial No -->
                        <div class="col-md-4">
                            <label class="form-label">Device Serial No <span class="text-danger">*</span></label>
                            <input type="text" name="serialNo"
                                class="form-control @error('serialNo') is-invalid @enderror"
                                value="{{ old('serialNo') }}">
                            @error('serialNo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- SIM Details Section (Dynamic Content) -->
            <div id="simDetails"></div>

            <!-- Form Actions -->
            <div class="d-flex justify-content-end mt-4">
                <button type="button" class="btn btn-outline-secondary me-3" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="submit" class="btn" style="background-color: #260950; color: white;">
                    <i class="fas fa-save me-2"></i>Create Barcode
                </button>
            </div>
        </form>
    </div>

    {{-- Pass preselected values from backend --}}
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
            sim_count: "{{ $barcode->sim_count ?? '' }}",
            sims: @json($barcode->sims ?? []) // array of sim details if editing
        };
    </script>
    <script>
        $(document).ready(function() {
            // ================== ELEMENT -> TYPE ==================
            $('.element').on('change', function() {
                const id = $(this).val();
                $('.element_type').empty().append('<option value="">Loading...</option>');
                if (id) {
                    $.get(`/manufacturer/fetch/element-type/${id}`, function(response) {
                        $('.element_type').empty().append('<option value="">Select Type</option>');
                        response.forEach(item => {
                            $('.element_type').append(
                                `<option value="${item.id}">${item.type}</option>`
                            );
                        });
                        if (window.preselected.element_type) {
                            $('.element_type').val(window.preselected.element_type).trigger(
                                'change');
                            window.preselected.element_type = null;
                        }
                    });
                }
            });

            // ================== TYPE -> MODEL ==================
            $('.element_type').on('change', function() {
                const id = $(this).val();
                $('.model-no').empty().append('<option value="">Loading...</option>');
                if (id) {
                    $.get(`/manufacturer/fetch/model-no/${id}`, function(response) {
                        $('.model-no').empty().append('<option value="">Select Model</option>');
                        response.forEach(item => {
                            $('.model-no').append(
                                `<option value="${item.id}">${item.model_no}</option>`
                            );
                        });
                        if (window.preselected.model_no) {
                            $('.model-no').val(window.preselected.model_no).trigger('change');
                            window.preselected.model_no = null;
                        }

                        // Sim auto-generate
                        if (window.preselected.sim_count > 0) {
                            generateSimFields(window.preselected.sim_count, window.preselected
                            .sims);
                            window.preselected.sim_count = 0;
                        }
                    });
                }
            });

            // ================== MODEL -> PART ==================
            $('.model-no').on('change', function() {
                const id = $(this).val();
                $('.partNo').empty().append('<option value="">Loading...</option>');
                if (id) {
                    $.get(`/manufacturer/fetch/part-no/${id}`, function(response) {
                        $('.partNo').empty().append('<option value="">Select Part</option>');
                        response.forEach(item => {
                            $('.partNo').append(
                                `<option value="${item.id}">${item.part_no}</option>`
                            );
                        });
                        if (window.preselected.part_no) {
                            $('.partNo').val(window.preselected.part_no).trigger('change');
                            window.preselected.part_no = null;
                        }
                    });
                }
            });

            // ================== PART -> TAC ==================
            $('.partNo').on('change', function() {
                const id = $(this).val();
                $('.tacNo').empty().append('<option value="">Loading...</option>');
                if (id) {
                    $.get(`/manufacturer/fetch/tac-no/${id}`, function(response) {
                        $('.tacNo').empty().append('<option value="">Select TAC</option>');
                        response.forEach(item => {
                            $('.tacNo').append(
                                `<option value="${item.id}">${item.tacNo}</option>`
                            );
                        });
                        if (window.preselected.tac_no) {
                            $('.tacNo').val(window.preselected.tac_no).trigger('change');
                            window.preselected.tac_no = null;
                        }
                    });
                }
            });

            // ================== TAC -> COP ==================
            $('.tacNo').on('change', function() {
                const id = $(this).val();
                $('.copNo').empty().append('<option value="">Loading...</option>');
                if (id) {
                    $.get(`/manufacturer/fetch/cop-no/${id}`, function(response) {
                        $('.copNo').empty().append('<option value="">Select COP</option>');
                        response.forEach(item => {
                            $('.copNo').append(
                                `<option value="${item.id}">${item.COPNo}</option>`
                            );
                        });
                        if (window.preselected.cop_no) {
                            $('.copNo').val(window.preselected.cop_no).trigger('change');
                            window.preselected.cop_no = null;
                        }
                    });
                }
            });

            // ================== COP -> TESTING AGENCY ==================
            $('.copNo').on('change', function() {
                const id = $(this).val();
                $('.testingAgency').empty().append('<option value="">Loading...</option>');
                if (id) {
                    $.get(`/manufacturer/fetch/testing-agency/${id}`, function(response) {
                        $('.testingAgency').empty().append(
                            '<option value="">Select Agency</option>');
                        response.forEach(item => {
                            $('.testingAgency').append(
                                `<option value="${item.id}">${item.testingAgency}</option>`
                            );
                        });
                        if (window.preselected.testing_agency) {
                            $('.testingAgency').val(window.preselected.testing_agency);
                            window.preselected.testing_agency = null;
                        }
                    });
                }
            });

            // ================== SIM FIELDS ==================
            function generateSimFields(count, sims = []) {
                let container = $('#simContainer');
                container.empty();
                for (let i = 0; i < count; i++) {
                    let sim = sims[i] || {};
                    container.append(`
                <div class="sim-block mb-3 p-2 border rounded">
                    <label>SIM ${i + 1} Number</label>
                    <input type="text" name="sim[${i}][number]" value="${sim.number ?? ''}" class="form-control">
                    
                    <label>ICCID</label>
                    <input type="text" name="sim[${i}][iccid]" value="${sim.iccid ?? ''}" class="form-control">
                    
                    <label>Operator</label>
                    <input type="text" name="sim[${i}][operator]" value="${sim.operator ?? ''}" class="form-control">
                </div>
            `);
                }
            }

            // ================== INITIAL AUTO SELECT ==================
            if (window.preselected.element) {
                $('.element').val(window.preselected.element).trigger('change');
            }
        });
    </script>


    {{-- <script>
        const $barCodeCreationType = $('#barCodeCreationType');

        $barCodeCreationType.on('change', function() {
            const selectedValue = $(this).val();

            const $simDetails = $("#simDetails");
            const $barcodeNo = $("#barcodeNoBox");
            const $bottomRow = $("#bottomRow");

            if (selectedValue == 'import') {
                // Hide elements
                $("#simDetails").hide();
                $("#barcodeNoBox").hide();
                $("#bottomRow").hide();
                // Set the form action to import route
                $('#creationForm').attr('action', '{{ route('barcode.spreadsheet.import') }}');
                // Avoid duplicating the file upload field on multiple imports
                if (!$('#fileUploadContainer').length) {
                    let templateUrl = '';

                    // Determine the template URL based on simcount value
                    const simcount = $('.element_type').find('option:selected').attr('simcount');
                    if (simcount === '2') {
                        templateUrl = "{{ route('barcode.templete.download', ['filename' => 'ais140.xlsx']) }}";
                    } else if (simcount === '1') {
                        templateUrl = "{{ route('barcode.templete.download', ['filename' => 'nonais.xlsx']) }}";
                    } else {
                        templateUrl = "{{ route('barcode.templete.download', ['filename' => 'nonvltd.xlsx']) }}";
                    }

                    // Create the HTML
                    const uploadHtml = `
                                        <div class="col-md-3" id="fileUploadContainer">
                                            <label for="importFile" class="form-label">Upload File (xml, csv)</label>
                                            <a href="${templateUrl}" class="mt-1">Download Template</a>
                                            <input type="file" name="import" id="importFile" class="form-control form-control-sm mt-1">
                                        </div>`;

                    // Insert the HTML after the specified container
                    $('#creationTypeContainer').after(uploadHtml);
                }



            } else {
                // Show the hidden elements again
                $simDetails.show();
                $barcodeNo.show();
                $bottomRow.show();

                // Reset the form action if needed
                $('#creationForm').attr('action', '{{ route('barcode.store') }}');

                // Remove the file upload field if it exists
                $('#fileUploadContainer').remove();
            }
        });
    </script> --}}

    <script>
        function handleCheckboxSelection(checkbox) {
            // Get all checkboxes in the table
            var checkboxes = document.querySelectorAll('.form-check-input');

            // Loop through all checkboxes
            checkboxes.forEach(function(item) {
                // If the current checkbox is not the one being clicked, uncheck it
                if (item !== checkbox) {
                    item.checked = false;
                }
            });

            // Get the value of the selected checkbox
            var selectedValue = checkbox.value;


            // Check if selectedValue is null or empty
            if (!selectedValue) {
                alert("Please select a device first.");
            } else {
                alert("Selected Device: " + selectedValue);
                $('#edit').attr('href', `/manufacturer/barcode/edit/${selectedValue}`);
                $('#view').attr('href', `/manufacturer/barcode/view/${selectedValue}`);
                $('#delete').attr('href', `/manufacturer/barcode/delete/${selectedValue}`);
            }
        }
    </script>
@endsection
