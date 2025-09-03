<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header" style="background-color: #260950; color: white;">
                <h5 class="modal-title">
                    <i class="fas fa-barcode me-2"></i>
                    Create New Barcode
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('barcode.store') }}" method="post" id="creationForm"
                    enctype="multipart/form-data">
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
                                    <select name="element"
                                        class="form-select element @error('element') is-invalid @enderror">
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
                                    <select name="model_no"
                                        class="form-select model-no @error('model_no') is-invalid @enderror">
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
                                    <select name="tacNo"
                                        class="form-select tacNo @error('tacNo') is-invalid @enderror">
                                        <option value="" selected disabled>Select TAC</option>
                                    </select>
                                    @error('tacNo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- COP No -->
                                <div class="col-md-3">
                                    <label class="form-label">COP No</label>
                                    <select name="copNo"
                                        class="form-select copNo @error('copNo') is-invalid @enderror">
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
                                    <select name="voltage"
                                        class="form-select voltage @error('voltage') is-invalid @enderror">
                                        <option value="" selected disabled>Select Voltage</option>
                                    </select>
                                    @error('voltage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Batch No -->
                                <div class="col-md-3">
                                    <label class="form-label">Batch No</label>
                                    <input type="text" name="batchNo"
                                        class="form-control @error('batchNo') is-invalid @enderror"
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
                                    <input type="text"
                                        class="form-control @error('barcodeNo') is-invalid @enderror"
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
                                    <select name="is_renew"
                                        class="form-select @error('is_renew') is-invalid @enderror">
                                        <option value="1" @selected(old('is_renew') == '1')>No</option>
                                        <option value="0" @selected(old('is_renew') == '0')>Yes</option>
                                    </select>
                                    @error('is_renew')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Serial No -->
                                <div class="col-md-4">
                                    <label class="form-label">Device Serial No <span
                                            class="text-danger">*</span></label>
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
        </div>
    </div>
</div>
