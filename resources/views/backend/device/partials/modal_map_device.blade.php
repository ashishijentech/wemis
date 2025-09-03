    <div class="modal fade" id="mapDevice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Map Device
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('map.device.store') }}" method="post" enctype="multipart/form-data">
                        <!-- RFC Header -->
                        @csrf
                        <div class="m-3 border border-secondary rounded">
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="mb-0 text-center">RFC Info</h5>
                            </div>

                            <!-- Form Body -->
                            <div class="p-3 border rounded">
                                <div class="row">
                                    @if (Auth::guard('manufacturer')->check())
                                        <!-- Country Dropdown -->
                                        <div class="form-group col-md-3">
                                            <label for="country">Country<span
                                                    class="text-danger badge">*</span></label>
                                            <select name="country" class="form-select-sm form-select country">
                                                <option disabled @selected(true)>Choose Country
                                                </option>
                                                <option value="china" @selected(old('country') == 'china')>China
                                                </option>
                                                <option value="india" @selected(old('country') == 'india')>India
                                                </option>
                                            </select>
                                            @error('country')
                                                <div class="d-block invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- State Dropdown -->
                                        <div class="form-group col-md-3">
                                            <label for="state">State</label> <span class="text-danger badge">*</span>
                                            <select class="form-select-sm form-select state" name="state"
                                                id=""></select>
                                            @error('state')
                                                <div class="d-block invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Distributor Dropdown -->

                                        <div class="form-group col-md-3">
                                            <label for="distributor">Distributor</label><span
                                                class="text-danger badge">*</span>
                                            <Select class="form-select-sm form-select distributor" name="distributor">
                                                <option value="">Select Distributor</option>
                                            </Select>
                                            @error('distributor')
                                                <div class="d-block invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <!-- Dealer Dropdown -->
                                        <div class="form-group col-md-3">
                                            <label for="dealer">Dealer </label><span
                                                class="text-danger badge">*</span>
                                            <Select class="form-select-sm form-select dealer" name="dealer">
                                                <option value="">Select Dealer</option>
                                            </Select>
                                            @error('dealer')
                                                <div class="d-block invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @elseif (Auth::guard('distributor')->check())
                                        <div class="form-group col-md-3">
                                            <label for="distributor">Dealer<span class="text-danger badge">*</span>
                                                <Select class="form-select-sm form-select dealer" name="dealer">
                                                    <option selected disabled>Select Dealer</option>
                                                    @foreach ($dealers as $item)
                                                        <option value="{{ $item->id }}"
                                                            country="{{ $item->country }}" state="{{ $item->state }}"
                                                            dis="{{ $item->district }}"
                                                            rto='@json($item->rto_devision)'>
                                                            {{ $item->business_name }}
                                                        </option>
                                                    @endforeach
                                                </Select>
                                                @error('distributor')
                                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    @elseif (Auth::guard('dealer')->check())
                                        <div class="form-group col-md-3">
                                            <label for="distributor">Dealer<span class="text-danger badge">*</span>
                                                <Select class="form-select-sm form-select dealer" name="dealer">
                                                    <option selected disabled>Select Dealer</option>
                                                    <option value="{{ auth()->user()->id }}"
                                                        country="{{ $item->country }}" state="{{ $item->state }}"
                                                        dis="{{ $item->district }}" rto='@json($item->rto_devision)'
                                                        readonly>
                                                        {{ auth()->user()->business_name }}
                                                    </option>
                                                </Select>
                                                @error('dealer')
                                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    @else
                                        <div class="form-group col-md-3">
                                            <label for="distributor">Dealer<span class="text-danger badge">*</span>
                                                <Select class="form-select-sm form-select dealer" name="dealer">
                                                    <option selected disabled>Select Dealer</option>
                                                    <option value="{{ $dealer }}" country="{{ $item->country }}"
                                                        state="{{ $item->state }}" dis="{{ $item->district }}"
                                                        rto='@json($item->rto_devision)' readonly>
                                                        {{ $dealer->business_name }}
                                                    </option>
                                                </Select>
                                                @error('dealer')
                                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="m-3 border border-secondary rounded">
                            <!-- Device Info Header -->
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="mb-0 text-center">Device Info</h5>
                            </div>

                            <!-- Form Body -->
                            <div class="p-2 border rounded">
                                <div class="row">
                                    <!-- Device Type Dropdown -->
                                    <div class="form-group col-md-4">
                                        <label for="deviceType">Device Type </label><span
                                            class="text-danger badge">*</span>
                                        <select id="deviceType" name="deviceType" class="form-select-sm form-select">
                                            <option>Select Device Type</option>
                                            <option value="New">New</option>
                                            <option value="Renewal">Renewal</option>
                                            <!-- Add more device types here if needed -->
                                        </select>
                                        @error('deviceType')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Device No Dropdown -->
                                    <div class="form-group col-md-4">
                                        <label for="deviceNo">Device No</label><span
                                            class="text-danger badge">*</span>
                                        <select name="deviceNo" class="form-select-sm form-select deviceno">
                                            <option>Select Device Number</option>
                                            <!-- Add more device numbers here if needed -->
                                        </select>
                                        @error('deviceNo')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Voltage Input (disabled) -->
                                    <div class="form-group col-md-4">
                                        <label for="voltage">Voltage</label>
                                        <input type="text" class="form-control form-control-sm voltage"
                                            name="voltage" placeholder="" readonly>
                                        @error('voltage')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Element Type Input (disabled) -->
                                    <div class="form-group col-md-4">
                                        <label for="elementType">Element Type</label>
                                        <input type="text" class="form-control form-control-sm element_type"
                                            id="elementType" name="elementType" placeholder="" readonly>
                                    </div>

                                    <!-- Batch No Input (disabled) -->
                                    <div class="form-group col-md-4">
                                        <label for="batchNo">Batch No.</label>
                                        <input type="text" class="form-control form-control-sm batch_no"
                                            id="batchNo" name="batchNo" placeholder="" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-3 border border-secondary rounded">
                            <!-- Form Header -->
                            <div class="bg-light p-2 border rounded-top simInfo">
                                <h5 class="mb-0 text-center">SIM Info</h5>
                            </div>
                        </div>

                        <div class="m-3 border border-secondary rounded">
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="mb-0 text-center">
                                    Vehicle Info
                                </h5>
                            </div>
                            <div class="p-3 border rounded">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="vehicleBirth">Vehicle Birth<span
                                                class="text-danger badge">*</span></label>
                                        <select id="vehicleBirth" name="vehicleBirth"
                                            class="form-select-sm form-select">
                                            <option selected value="Old">Old</option>
                                            <option value="New">New</option>
                                        </select>
                                        @error('vehicleBirth')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4" id="vaicleregNumber">
                                        <label for="regNumber">Registration No.<span
                                                class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="regNumber"
                                            name="regNumber" placeholder="Enter Registration Number">
                                        @error('regNumber')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4" id="vaicledate">
                                        <label for="date">Date<span class="text-danger badge">*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="date"
                                            name="regdate">
                                        @error('date')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="chassisNumber">Chassis Number<span
                                                class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="chassisNumber"
                                            name="chassisNumber" placeholder="Enter Chassis Number">
                                        @error('chassisNumber')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="engineNumber">Engine Number<span
                                                class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="engineNumber"
                                            name="engineNumber" placeholder="Enter Engine Number">
                                        @error('engineNumber')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="vehicleType">Vehicle Type<span
                                                class="text-danger badge">*</span></label>
                                        <select id="vehicleType" name="vehicleType"
                                            class="form-control form-control-sm">
                                            <option selected>Choose Vehicle Type</option>
                                            <option value="AUTO">AUTO</option>
                                            <option value="BUS">BUS</option>
                                            <option value="JCB">JCB</option>
                                            <option value="MAXI CAB">MAXI CAB</option>
                                            <option value="OIL TANK">OIL TANK</option>
                                            <option value="PICKUP">PICKUP</option>
                                            <option value="SCHOOL BUS">SCHOOL BUS</option>
                                            <option value="TANK TRUCK">TANK TRUCK</option>
                                            <option value="TAXI">TAXI</option>
                                            <option value="TEMPO">TEMPO</option>
                                            <option value="TRACTOR">TRACTOR</option>
                                            <option value="TRAILER TRUCK">TRAILER TRUCK</option>
                                            <option value="TRAVILER">TRAVILER</option>
                                            <option value="TRUCK">TRUCK</option>
                                        </select>
                                        @error('vehicleType')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="makeModel">Make & Model<span
                                                class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="vaiModel"
                                            name="vaiclemodel" placeholder="Enter Make & Model">
                                        @error('vaiclemodel')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="modelYear">Model Year<span
                                                class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control" id="modelYear"
                                            name="vaimodelyear" placeholder="Enter Model Year">
                                        @error('vaimodelyear')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="insurance">Insu. Renew date</label>
                                        <input type="date" class="form-control" id="insurance"
                                            name="vaicleinsurance">
                                        @error('vaicleinsurance')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="panicButton">Pollution Renew date</label>
                                        <input type="date" class="form-control" id="panicButton"
                                            name="pollutiondate">
                                        @error('pollutiondate')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-3 border border-secondary rounded">
                            <div class="bg-light p-3 border rounded-top">
                                <h5 class="mb-0 text-center">Customer Info</h5>
                            </div>
                            <div class="p-3 border rounded">
                                <div class="mb-4 row g-3">
                                    <!-- Customer Name -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="shadow-sm form-control" id="customerName"
                                                name="customerName" placeholder="Enter Name"
                                                value="{{ old('customerName') }}">
                                            <label for="customerName" class="text-muted small">Full Name <span
                                                    class="text-danger">*</span></label>
                                            @error('customerName')
                                                <div class="d-block invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Customer Email -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="email" class="shadow-sm form-control" id="email"
                                                name="customerEmail" placeholder="Enter Email"
                                                value="{{ old('customerEmail') }}">
                                            <label for="email" class="text-muted small">Email Address</label>
                                            @error('customerEmail')
                                                <div class="d-block invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Customer Mobile -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="tel" class="shadow-sm form-control" id="mobile"
                                                name="customerMobile" placeholder="Enter Mobile"
                                                value="{{ old('customerMobile') }}" autocomplete="off">
                                            <label for="mobile" class="text-muted small">Mobile Number <span
                                                    class="text-danger">*</span></label>
                                            @error('customerMobile')
                                                <div class="d-block invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- GSTIN Number -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="shadow-sm form-control" id="gstin"
                                                name="customergstin" placeholder="Enter GSTIN"
                                                value="{{ old('customergstin') }}">
                                            <label for="gstin" class="text-muted small">GSTIN Number</label>
                                            @error('customergstin')
                                                <div class="d-block invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Country -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="bg-light shadow-sm form-control"
                                                name="country" id="country" value="{{ old('country') }}" readonly
                                                autocomplete="off" onkeydown="return false;">
                                            <label for="country" class="text-muted small">Country <span
                                                    class="text-danger">*</span></label>
                                            @error('country')
                                                <div class="d-block invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- State -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="bg-light shadow-sm form-control"
                                                name="state" id="state" value="{{ old('state') }}" readonly
                                                autocomplete="off" onkeydown="return false;">
                                            <label for="state" class="text-muted small">State/Region <span
                                                    class="text-danger">*</span></label>
                                            @error('state')
                                                <div class="d-block invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row g-3">
                                    <!-- District -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="bg-light shadow-sm form-control"
                                                name="coustomerDistrict" id="district"
                                                value="{{ old('coustomerDistrict') }}" readonly autocomplete="off"
                                                onkeydown="return false;">
                                            <label for="district" class="text-muted small">District <span
                                                    class="text-danger">*</span></label>
                                            @error('coustomerDistrict')
                                                <div class="d-block invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- RTO Division -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select class="shadow-sm form-select" name="rto_devision"
                                                id="rto_division">
                                                <option value="" selected disabled hidden>Select RTO Division
                                                </option>
                                                <!-- Options will be populated dynamically -->
                                            </select>
                                            <label for="rto_division" class="text-muted small">RTO Division <span
                                                    class="text-danger">*</span></label>
                                            @error('rto_division')
                                                <div class="d-block invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>

                                    <!-- Pin Code -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="shadow-sm form-control"
                                                name="coustomerPincode" id="pincode"
                                                value="{{ old('coustomerPincode') }}">
                                            <label for="pincode" class="text-muted small">Pin Code <span
                                                    class="text-danger">*</span></label>
                                            @error('coustomerPincode')
                                                <div class="d-block invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-8">
                                        <div class="form-floating">
                                            <input type="text" class="shadow-sm form-control" id="address"
                                                name="coustomeraddress" placeholder=" "
                                                value="{{ old('coustomeraddress') }}">
                                            <label for="address" class="text-muted small">Complete Address <span
                                                    class="text-danger">*</span></label>
                                            @error('coustomeraddress')
                                                <div class="d-block invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Aadhaar -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="shadow-sm form-control" id="aadhaar"
                                                name="customeraadhar" placeholder=" "
                                                value="{{ old('customeraadhar') }}">
                                            <label for="aadhaar" class="text-muted small">Aadhaar Number <span
                                                    class="text-danger">*</span></label>
                                            @error('customeraadhar')
                                                <div class="d-block invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- PAN Number -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="shadow-sm form-control" id="panNo"
                                                name="customerpanno" placeholder=" "
                                                value="{{ old('customerpanno') }}">
                                            <label for="panNo" class="text-muted small">PAN Number <span
                                                    class="text-danger">*</span></label>
                                            @error('customerpanno')
                                                <div class="d-block invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-3 border border-secondary rounded">
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="mb-0 text-center">Packages</h5>
                            </div>
                            <div class="p-3 border rounded">
                                <div class="justify-content-center row">
                                    @foreach ($subscriptions as $item)
                                        <div class="mb-2 col-md-3 Packages">
                                            <div class="shadow-sm h-100 text-center select-subscription"
                                                data-id="" style="width: 100%; cursor: pointer;">
                                                <!-- Added cursor:pointer for click indication -->
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="card-title fw-bold">{{ $item->packageName }}</h5>
                                                        <span class="packageId" hidden>{{ $item->id }}</span>
                                                        <div class="d-flex align-items-center">
                                                            <i class="me-1 bi bi-clock"></i>
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                    <h5 class="mt-2"><i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {{ $item->price }}</h5>
                                                    <p class="text-white">{{ $item->billingCycle }}</p>
                                                    {{-- <p class="card-text">{{$item->description}}</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('subscriptionpackage')
                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                @enderror
                                <input type="hidden" name="subscriptionpackage" id="subscriptionpackage">
                            </div>

                        </div>
                        <div class="m-3 border border-secondary rounded">
                            <div class="bg-light p-3 border rounded-top">
                                <div class="align-items-center row">
                                    <!-- Technician Info Title -->
                                    <div class="text-center col-md-6">
                                        <h5>Technician Info</h5>
                                    </div>

                                    <!-- Select Technician Dropdown -->
                                    <div class="col-md-3">
                                        <select class="form-select-sm form-select technician" name="technician">
                                            <option selected disabled>Select Technician</option>
                                        </select>
                                        @error('technician')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Add Technician Button -->
                                    <div class="text-end col-md-3">
                                        {{-- <button type="button" class="btn" data-bs-toggle="modal"
                                            data-bs-target="#addTechnician" style="background-color: #260950;color:#fff">
                                            Add Technician
                                        </button> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 row">
                                <div class="form-group col-md-4">
                                    <label for="firstName" class="form-label">Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="technician_name"
                                        name="name" placeholder="First Name" require readonly autocomplete="off">

                                    @error('name')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="lastName" class="form-label">Last Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="lastName"
                                        name="techlastName" placeholder="Last Name" require>
                                </div> --}}
                                <div class="form-group col-md-4">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="technician_email"
                                        name="techemail" placeholder="Email" readonly autocomplete="off">
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="Gender" name="techgender"
                                        placeholder="Gender">
                                </div> --}}
                                <div class="form-group col-md-4">
                                    <label for="mobile" class="form-label">Mobile <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="technician_mobile"
                                        name="techmobile" placeholder="Mobile" readonly autocomplete="off">
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="dob" class="form-label">Date Of Birth</label>
                                    <input type="date" class="form-control form-control-sm" id="dob" name="techdob"
                                        placeholder="Date Of Birth">
                                </div> --}}
                            </div>
                        </div>



                        <div class="m-3 border border-secondary rounded">
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="mb-0 text-center">Installation Detail</h5>
                            </div>
                            <div class="p-3 border rounded">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="InvoiceNo" class="form-label">Invoice No<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="InvoiceNo"
                                            name="InvoiceNo">
                                        @error('InvoiceNo')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Vehicle KM Reading" class="form-label">Vehicle KM
                                            Reading<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm"
                                            id="VehicleKMReading" name="VehicleKMReading">
                                        @error('VehicleKMReading')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Driver License No" class="form-label">Driver License
                                            No<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm"
                                            id="DriverLicenseNo" name="DriverLicenseNo">
                                        @error('DriverLicenseNo')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Mapped Date" class="form-label">Mapped Date<span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="MappedDate"
                                            name="MappedDate">
                                        @error('MappedDate')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="No Of Panic Buttons" class="form-label">No Of Panic
                                            Buttons<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm"
                                            id="NoOfPanicButtons" name="NoOfPanicButtons">
                                        @error('NoOfPanicButtons')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-3 border border-secondary rounded">
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="mb-0 text-center">Vehicle Document (* document)</h5>
                            </div>
                            <div class="p-3 border rounded">
                                <p class="mb-2 text-danger text-center small">
                                    * File types supported: PNG, JPG, JPEG, PDF only. File size should be up to 6MB.
                                </p>

                                <div class="mb-3 row">
                                    <div class="col-md-4">
                                        <label for="vehicle" class="form-label">Vehicle</label>
                                        <input type="file" class="form-control form-control-sm preview-upload"
                                            id="vehicle" name="vehicleimg" accept=".png,.jpg,.jpeg,.pdf">
                                        <div class="mt-2 text-center">
                                            <img id="preview-vehicle" class="border rounded img-fluid d-none"
                                                alt="Vehicle Preview" style="max-height: 150px;">
                                        </div>
                                        @error('vehicleimg')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="rc" class="form-label">RC</label>
                                        <input type="file" class="form-control form-control-sm preview-upload"
                                            id="rc" name="vehiclerc" accept=".png,.jpg,.jpeg,.pdf">
                                        <div class="mt-2 text-center">
                                            <img id="preview-rc" class="border rounded img-fluid d-none"
                                                alt="RC Preview" style="max-height: 150px;">
                                        </div>
                                        @error('vehiclerc')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="device" class="form-label">Device</label>
                                        <input type="file" class="form-control form-control-sm preview-upload"
                                            id="device" name="vaicledeviceimg" accept=".png,.jpg,.jpeg,.pdf">
                                        <div class="mt-2 text-center">
                                            <img id="preview-device" class="border rounded img-fluid d-none"
                                                alt="Device Preview" style="max-height: 150px;">
                                        </div>
                                        @error('vaicledeviceimg')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-md-4">
                                        <label for="pan" class="form-label">Pan Card</label>
                                        <input type="file" class="form-control form-control-sm preview-upload"
                                            id="pan" name="pancardimg" accept=".png,.jpg,.jpeg,.pdf">
                                        <div class="mt-2 text-center">
                                            <img id="preview-pan" class="border rounded img-fluid d-none"
                                                alt="Pan Card Preview" style="max-height: 150px;">
                                        </div>
                                        @error('pancardimg')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="aadhaar" class="form-label">Aadhaar Card</label>
                                        <input type="file" class="form-control form-control-sm preview-upload"
                                            id="aadhaar" name="aadharcardimg" accept=".png,.jpg,.jpeg,.pdf">
                                        <div class="mt-2 text-center">
                                            <img id="preview-aadhaar" class="border rounded img-fluid d-none"
                                                alt="Aadhaar Card Preview" style="max-height: 150px;">
                                        </div>
                                        @error('aadharcardimg')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="invoice" class="form-label">Invoice</label>
                                        <input type="file" class="form-control form-control-sm preview-upload"
                                            id="invoice" name="invoiceimg" accept=".png,.jpg,.jpeg,.pdf">
                                        <div class="mt-2 text-center">
                                            <img id="preview-invoice" class="border rounded img-fluid d-none"
                                                alt="Invoice Preview" style="max-height: 150px;">
                                        </div>
                                        @error('invoiceimg')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-md-4">
                                        <label for="signature" class="form-label">Signature</label>
                                        <input type="file" class="form-control form-control-sm preview-upload"
                                            id="signature" name="signatureimg" accept=".png,.jpg,.jpeg,.pdf">
                                        <div class="mt-2 text-center">
                                            <img id="preview-signature" class="border rounded img-fluid d-none"
                                                alt="Signature Preview" style="max-height: 150px;">
                                        </div>
                                        @error('signatureimg')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="panic" class="form-label">Panic Button with Sticker</label>
                                        <input type="file" class="form-control form-control-sm preview-upload"
                                            id="panic" name="panicbuttonimg" accept=".png,.jpg,.jpeg,.pdf">
                                        <div class="mt-2 text-center">
                                            <img id="preview-panic" class="border rounded img-fluid d-none"
                                                alt="Panic Button Preview" style="max-height: 150px;">
                                        </div>
                                        @error('panicbuttonimg')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="my-2 text-center">
                            <button type="submit" class="btn"
                                style="background-color: #260950;color:#fff">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
