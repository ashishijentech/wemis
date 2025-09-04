@extends('layouts.manufacturer')
@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="row align-items-center py-3 mb-4"
            style="background: linear-gradient(135deg, #260950 0%, #260950 100%); border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <h4 class="text-white mb-0 px-3 py-2 fw-bold">
                        <i class="fas fa-barcode me-2"></i>
                        Barcode Management
                    </h4>
                    <span class="badge bg-light text-dark ms-2">Total: {{ count($barCode) }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-end pe-3">
                    <a class="btn btn-theme t d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        <i class="fas fa-plus-circle me-2"></i>
                        Add Barcode
                    </a>
                </div>
            </div>
        </div>

        <!-- Alerts Section -->
        <div class="row mb-4">
            <div class="col-12">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>{{ Session::get('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>{{ Session::get('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100"
                    style="background: linear-gradient(135deg, #260950 0%, #3a1b7a 100%);">
                    <div class="card-body text-center py-3">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <i class="fas fa-microchip text-white fs-4 me-2"></i>
                            <h3 class="card-title text-white mb-0">
                                {{ App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->count() }}
                            </h3>
                        </div>
                        <p class="card-text text-white mb-0">TOTAL DEVICES</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100"
                    style="background: linear-gradient(135deg, #086c57 0%, #0d9d7f 100%);">
                    <div class="card-body text-center py-3">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <i class="fas fa-check-circle text-white fs-4 me-2"></i>
                            <h3 class="card-title text-white mb-0">
                                {{ App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', '0')->count() }}
                            </h3>
                        </div>
                        <p class="card-text text-white mb-0">AVAILABLE DEVICES</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100"
                    style="background: linear-gradient(135deg, #e9b517 0%, #f5c542 100%);">
                    <div class="card-body text-center py-3">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <i class="fas fa-user-clock text-white fs-4 me-2"></i>
                            <h3 class="card-title text-white mb-0">
                                {{ App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', '1')->count() }}
                            </h3>
                        </div>
                        <p class="card-text text-white mb-0">ALLOCATED DEVICES</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100"
                    style="background: linear-gradient(135deg, #dc3545 0%, #e4606d 100%);">
                    <div class="card-body text-center py-3">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <i class="fas fa-bolt text-white fs-4 me-2"></i>
                            <h3 class="card-title text-white mb-0">
                                {{ App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', '2')->count() }}
                            </h3>
                        </div>
                        <p class="card-text text-white mb-0">INSTALLED DEVICES</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-search me-2"></i> Search Barcode
                </h6>
            </div>
            <div class="card-body">
                <form action="{{-- route('barcode.search') --}}" method="GET" class="row g-3">
                    @csrf

                    <!-- Device Serial No -->
                    <div class="col-md-5">
                        <label for="serialNo" class="form-label">Device Serial No</label>
                        <input type="text" name="serialNo" id="serialNo" class="form-control"
                            placeholder="Enter Serial Number" value="{{ request('serialNo') }}">
                    </div>

                    <!-- Device IMEI -->
                    <div class="col-md-5">
                        <label for="imei" class="form-label">Device IMEI</label>
                        <input type="text" name="imei" id="imei" class="form-control"
                            placeholder="Enter IMEI Number" value="{{ request('imei') }}">
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2 w-100">
                            <i class="fas fa-search me-1"></i> Search
                        </button>
                        <a href="{{ route('barcode.allocate') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-undo me-1"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>


        <div class="d-flex justify-content-end align-items-center mb-3">
            <a href="" class="btn btn-warning btn-sm me-2" id="edit"
                onclick="return confirm('Are you sure you want to edit this?')">
                Edit
            </a>
            <a href="" class="btn btn-danger btn-sm me-2" id="delete"
                onclick="return confirm('Are you sure you want to delete this?')">
                Delete
            </a>
            <a href="#" class="btn btn-info btn-sm" id="view">
                View
            </a>
        </div>


        <!-- Data Table Section -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-list-alt me-2 text-primary"></i>
                        Barcode Records
                    </h5>
                </div>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-hover dataTable align-middle mb-0" id="barcodeTable">
                        <thead class="table-light">
                            <tr>
                                <th></th>
                                <th class="ps-4">Device Serial No</th>
                                <th>SIM Details</th>
                                <th>ICCID No / SIM Manufacture</th>
                                <th>Type</th>
                                <th>Model No</th>
                                <th>Part No</th>
                                <th>Barcode Type</th>
                                <th>Created At</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barCode as $item)
                                <tr>
                                    <td>
                                        <input class="form-check-input ms-1 pb-2" type="checkbox"
                                            value="{{ $item->id }}" onchange="handleCheckboxSelection(this)">
                                    </td>

                                    <td class="ps-4">
                                        <a href="#" class="text-primary fw-semibold" data-bs-toggle="modal"
                                            data-bs-target="#deviceModal{{ $loop->iteration }}" title="Device Info">
                                            <div>{{ $item->serialNumber }}</div>
                                            <small class="text-muted">{{ $item->barcodeNo }}</small>
                                        </a>
                                    </td>
                                    <td>
                                        @php
                                            $sim = DB::table('sims')->where('barcode_id', $item->id)->get();
                                        @endphp
                                        @foreach ($sim as $simdata)
                                            <a href="#" class="d-block text-primary" data-bs-toggle="modal"
                                                data-bs-target="#SimModal{{ $simdata->simNo }}" title="Sim Info">
                                                {{ $simdata->simNo }}
                                            </a>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($sim as $simdata)
                                            <div>{{ $simdata->ICCIDNo }}</div>
                                            <small class="text-primary">{{ $simdata->manufacture }}</small>
                                        @endforeach
                                    </td>
                                    <td>{{ $item->elementType->pluck('type')->first() }}</td>
                                    <td>{{ $item->modelNo->pluck('model_no')->first() }}</td>
                                    <td>{{ $item->partNo->pluck('part_no')->first() }}</td>
                                    <td>
                                        @if ($item->is_renew == 0)
                                            <span class="badge bg-success bg-opacity-10 text-success">NEW</span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary">RENEWED</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                    <td class="text-center">
                                        @if ($item->status == 0)
                                            <span class="badge bg-success">ACTIVE</span>
                                        @elseif($item->status == 1)
                                            <span class="badge bg-warning">ALLOCATED</span>
                                        @else
                                            <span class="badge bg-danger">USED</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SIM Modal Template -->
    @foreach ($barCode as $item)
        @php
            $sim = DB::table('sims')->where('barcode_id', $item->id)->get();
        @endphp
        @foreach ($sim as $simdata)
            <div class="modal fade" id="SimModal{{ $simdata->simNo }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header" style="background-color: #260950;color:#fff">
                            <h5 class="modal-title">
                                <i class="fas fa-sim-card me-2"></i>
                                SIM Information
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Basic Information</h6>
                                        </div>
                                        <div class="card-body">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-5">SIM No.</dt>
                                                <dd class="col-sm-7">{{ $simdata->simNo }}</dd>

                                                <dt class="col-sm-5">ICCID No.</dt>
                                                <dd class="col-sm-7">{{ $simdata->ICCIDNo }}</dd>

                                                <dt class="col-sm-5">Operator</dt>
                                                <dd class="col-sm-7">{{ $simdata->operator }}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Validity & Details</h6>
                                        </div>
                                        <div class="card-body">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-5">Valid Till</dt>
                                                <dd class="col-sm-7">{{ $simdata->validity }}</dd>

                                                <dt class="col-sm-5">Manufacturer</dt>
                                                <dd class="col-sm-7">{{ $simdata->manufacture }}</dd>

                                                <dt class="col-sm-5">Created At</dt>
                                                <dd class="col-sm-7">
                                                    {{ \Carbon\Carbon::parse($simdata->created_at)->format('d M Y H:i') }}
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Device Modal Template -->
        <div class="modal fade" id="deviceModal{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-barcode me-2"></i>
                            Device Details: {{ $item->barcodeNo }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion" id="deviceAccordion{{ $loop->iteration }}">
                            <!-- Device Details Card -->
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingOne{{ $loop->iteration }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne{{ $loop->iteration }}" aria-expanded="true"
                                        aria-controls="collapseOne{{ $loop->iteration }}">
                                        <i class="fas fa-microchip me-2"></i> Device Information
                                    </button>
                                </h2>
                                <div id="collapseOne{{ $loop->iteration }}" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne{{ $loop->iteration }}"
                                    data-bs-parent="#deviceAccordion{{ $loop->iteration }}">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Device Serial Number</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->serialNumber }}" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Barcode Number</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->barcodeNo }}" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">IMEI Number</label>
                                                <input type="text" class="form-control" value="{{ $item->IMEINO }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Element Type</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->elementType->pluck('type')->first() }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Model Details Card -->
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingTwo{{ $loop->iteration }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo{{ $loop->iteration }}" aria-expanded="false"
                                        aria-controls="collapseTwo{{ $loop->iteration }}">
                                        <i class="fas fa-box-open me-2"></i> Model Specifications
                                    </button>
                                </h2>
                                <div id="collapseTwo{{ $loop->iteration }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo{{ $loop->iteration }}"
                                    data-bs-parent="#deviceAccordion{{ $loop->iteration }}">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Model Number</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->modelNo->pluck('model_no')->first() }}" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Part Number</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->partNo->pluck('part_no')->first() }}" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Voltage</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->modelNo->pluck('voltage')->first() }}" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Batch Number</label>
                                                <input type="text" class="form-control" value="{{ $item->BatchNo }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Manufacturer Details Card -->
                            <div class="accordion-item border-0 shadow-sm">
                                <h2 class="accordion-header" id="headingThree{{ $loop->iteration }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree{{ $loop->iteration }}" aria-expanded="false"
                                        aria-controls="collapseThree{{ $loop->iteration }}">
                                        <i class="fas fa-industry me-2"></i> Manufacturer Details
                                    </button>
                                </h2>
                                <div id="collapseThree{{ $loop->iteration }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree{{ $loop->iteration }}"
                                    data-bs-parent="#deviceAccordion{{ $loop->iteration }}">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Manufacturer</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->manufacturer->pluck('businees_name')->first() }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Created At</label>
                                                <input type="text" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Modified At</label>
                                                <input type="text" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y H:i') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @include('backend.barcode.partials.create')

    <script>
        $(document).ready(function() {
            // 🔹 Reusable AJAX fetch function
            function fetchAndPopulate($target, url, placeholder, optionMapper) {
                $target.html('<option value="">Loading...</option>');
                $.ajax({
                    url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $target.empty().append(`<option value="">${placeholder}</option>`);
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => $target.append(optionMapper(item)));
                        } else {
                            $target.append('<option value="">No options available</option>');
                        }
                    },
                    error: function() {
                        $target.empty().append('<option value="">Failed to load options</option>');
                    }
                });
            }

            // 🔹 Element change → Fetch element type
            $(document).on('change', '.element', function() {
                const $form = $(this).closest("form");
                const $elementType = $form.find(".element_type");
                fetchAndPopulate(
                    $elementType,
                    `/manufacturer/fetch/element-type/${$(this).val()}`,
                    "Select Element Type",
                    type =>
                    `<option value="${type.id}" simcount="${type.sim_count}">${type.type}</option>`
                );
            });

            // 🔹 Element type change → SIM details + Model/Voltage
            $(document).on('change', '.element_type', function() {
                const simCount = $(this).find('option:selected').attr('simcount');
                const $form = $(this).closest("form");
                const $simDetailsContainer = $('#simDetails').empty();

                // SIM details
                if (simCount > 0) {
                    $simDetailsContainer.append(`
                <div class="mb-3">
                    <h5 class="text-primary"><i class="fas fa-sim-card me-2"></i> SIM Card Details</h5>
                    <hr class="mt-1">
                </div>
            `);
                    for (let i = 1; i <= simCount; i++) {
                        $simDetailsContainer.append(`
                    <div class="card mb-3 sim-entry" data-sim-index="${i}">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                            <h6 class="mb-0"><span class="badge bg-primary me-2">${i}</span> SIM Card Configuration</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-sim" title="Remove SIM"><i class="fas fa-trash-alt"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">SIM Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="simNo[]" placeholder="e.g. 9876543210123" pattern="[0-9]{13}" title="13-digit SIM number">
                                    <div class="invalid-feedback">Please enter a valid 13-digit SIM number</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">ICCID Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="iccidNo[]" placeholder="25 chars" pattern=".{25}" title="25 characters required">
                                    <div class="invalid-feedback">Please enter a valid ICCID number</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Validity Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="validity[]" min="${new Date().toISOString().split('T')[0]}">
                                    <div class="invalid-feedback">Please select a future date</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Operator <span class="text-danger">*</span></label>
                                    <select class="form-select" name="operator[]">
                                        <option value="" disabled selected>Select Operator</option>
                                        <option value="Airtel">Airtel</option>
                                        <option value="Jio">Jio</option>
                                        <option value="Vodafone Idea">Vodafone Idea</option>
                                        <option value="BSNL">BSNL</option>
                                        <option value="MTNL">MTNL</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="invalid-feedback">Please select an operator</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                    }
                }

                // Model & Voltage
                const $modelNo = $form.find(".model-no");
                const $voltage = $form.find(".voltage");
                fetchAndPopulate(
                    $modelNo.add($voltage),
                    `/manufacturer/fetch/model-no/${$(this).val()}`,
                    "Select Model/Voltage",
                    model => {
                        $modelNo.append(`<option value="${model.id}">${model.model_no}</option>`);
                        $voltage.append(`<option value="${model.id}">${model.voltage}</option>`);
                    }
                );
            });

            // 🔹 Remove SIM card
            $(document).on('click', '.btn-remove-sim', function() {
                const $card = $(this).closest('.sim-entry');
                if (confirm(`Are you sure you want to remove SIM ${$card.data('sim-index')}?`)) {
                    $card.remove();
                }
            });

            // 🔹 Model No → Part No
            $(document).on('change', '.model-no', function() {
                const $form = $(this).closest("form");
                fetchAndPopulate(
                    $form.find(".partNo"),
                    `/manufacturer/fetch/part-no/${$(this).val()}`,
                    "Select Part No.",
                    part => `<option value="${part.id}">${part.part_no}</option>`
                );
            });

            // 🔹 Part No → TAC No
            $(document).on('change', '.partNo', function() {
                const $form = $(this).closest("form");
                fetchAndPopulate(
                    $form.find(".tacNo"),
                    `/manufacturer/fetch/tac-no/${$(this).val()}`,
                    "Select TAC No.",
                    tac => `<option value="${tac.id}">${tac.tacNo}</option>`
                );
            });

            // 🔹 TAC No → COP No
            $(document).on('change', '.tacNo', function() {
                const $form = $(this).closest("form");
                fetchAndPopulate(
                    $form.find(".copNo"),
                    `/manufacturer/fetch/cop-no/${$(this).val()}`,
                    "Select COP No.",
                    cop => `<option value="${cop.id}" validity="${cop.validTill}">${cop.COPNo}</option>`
                );
            });

            // 🔹 COP No → Validity + Testing Agency
            $(document).on('change', '.copNo', function() {
                const $form = $(this).closest("form");
                const validity = $(this).find('option:selected').attr('validity') || '';
                $form.find(".copValidTill").val(validity);

                fetchAndPopulate(
                    $form.find(".testingAgency"),
                    `/manufacturer/fetch/testing-agency/${$(this).val()}`,
                    "Select Testing Agency",
                    agency => `<option value="${agency.id}">${agency.testingAgency}</option>`
                );
            });
        });
    </script>


    <script>
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
    </script>

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
