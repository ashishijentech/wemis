@extends($layouts)
@section('content')
    <div class="mb-3 card">
        <div class="card-body">
            <div class="align-items-center mb-3 row" style="background-color: #260950;">
                <!-- Use align-items-center here -->
                <div class="col-md-4">
                    <h4 class="px-2 py-3 text-white card-title">Dealers List</h4>
                </div>
                <div class="col-md-8">
                    <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                        <button class="btn btn-sm btn-theme" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fa-solid fa-plus"></i> Create Dealer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> {{ Session::get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> {{ Session::get('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h5 class="text-capitalize"><em>It shows the list of Dealers and their details</em></h5>
                <div class="col-md-12">
                    <table class="table table-bordered dataTable">
                        <thead class="text-white" style="background-color: #260950">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Distributor</th>
                                <th scope="col">Business Name </th>
                                <th scope="col">Owner Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact No</th>
                                <th scope="col">Password</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dealers as $item)
                                {{-- {{ $item }} --}}
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->distributor->business_name }}</td>
                                    <td>{{ $item->business_name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->passwordText }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen"
                                                style="color:#fff"></i></a>
                                        <form action="" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this item?');"><i
                                                    class="fa-solid fa-trash" style="color:#fff"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModal">Create Dealer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dealer.store') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="card">
                            <div class="mx-3 my-3">

                                @if (Auth::guard('manufacturer')->check())
                                    <div class="mb-2 row">
                                        <div class="col-md-12">
                                            <label for="distributer" class="form-label">Select Distributor</label>
                                            <select name="distributer"
                                                class="form-select-sm form-select @error('distributer') is-invalid @enderror"
                                                id="distributer" required>
                                                <option disabled selected>Select Distributor</option>
                                                @foreach ($distributor as $item)
                                                    <option value="{{ $item->id }}">{{ $item->business_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a distributor.</div>
                                            @error('distributer')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Business Name<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('business_name') is-invalid @enderror"
                                            name="business_name" value="{{ old('business_name') }}" required>
                                        <div class="invalid-feedback">Please enter a business name.</div>
                                        @error('business_name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Name<span class="text-secondary badge">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" required>
                                        <div class="invalid-feedback">Please enter a name.</div>
                                        @error('name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Email<span class="text-secondary badge">*</span></label>
                                        <input type="email"
                                            class="form-control form-control-sm @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required>
                                        <div class="invalid-feedback">Please enter a valid email.</div>
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mx-3 mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Gender<span
                                                class="text-secondary badge">*</span></label>
                                        <select name="gender"
                                            class="form-select-sm form-select @error('gender') is-invalid @enderror"
                                            required>
                                            <option hidden selected value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <div class="invalid-feedback">Please select gender.</div>
                                        @error('gender')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Mobile<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="number"
                                            class="form-control form-control-sm @error('mobile') is-invalid @enderror"
                                            name="mobile" value="{{ old('mobile') }}" required>
                                        <div class="invalid-feedback">Please enter mobile number.</div>
                                        @error('mobile')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Date Of Birth<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="date"
                                            class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror"
                                            name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                        <div class="invalid-feedback">Please select date of birth.</div>
                                        @error('date_of_birth')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Age<span class="text-secondary badge">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="age"
                                            value="{{ old('age') }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="mx-3 mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Is Map Device Edit<span
                                                class="text-secondary badge">*</span></label>
                                        <select name="is_map_device_edit"
                                            class="form-select-sm form-select @error('is_map_device_edit') is-invalid @enderror"
                                            required>
                                            <option selected disabled value="">Select Option</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <div class="invalid-feedback">Please select an option.</div>
                                        @error('is_map_device_edit')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Pan Number<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('pan_number') is-invalid @enderror"
                                            name="pan_number" value="{{ old('pan_number') }}" required>
                                        <div class="invalid-feedback">Please enter PAN number.</div>
                                        @error('pan_number')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Occupation<span
                                                class="text-secondary badge">*</span></label>
                                        <select name="occupation"
                                            class="form-select-sm form-select @error('occupation') is-invalid @enderror"
                                            required>
                                            <option hidden value="">Select Occupation</option>
                                            <option value="Business Man">Business Man</option>
                                            <option value="Student">Student</option>
                                            <option value="House Wife">House Wife</option>
                                            <option value="VRS Employees">VRS Employees</option>
                                            <option value="Retired Employees">Retired Employees</option>
                                            <option value="Self Employed">Self Employed</option>
                                            <option value="Private Employees">Private Employees</option>
                                            <option value="Marketing Executives">Marketing Executives</option>
                                        </select>
                                        <div class="invalid-feedback">Please select occupation.</div>
                                        @error('occupation')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Advance Payment<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="number"
                                            class="form-control form-control-sm @error('advance_payment') is-invalid @enderror"
                                            name="advance_payment" value="{{ old('advance_payment') }}" required>
                                        <div class="invalid-feedback">Please enter advance payment.</div>
                                        @error('advance_payment')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mx-3 mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Languages Known<span
                                                class="text-secondary badge">*</span></label><br>
                                        <select multiple
                                            class="form-control chosen-select @error('language_known') is-invalid @enderror"
                                            name="language_known[]" required>
                                            <option value="english">English</option>
                                            <option value="hindi">Hindi</option>
                                            <option value="odiya">Odiya</option>
                                        </select>
                                        <div class="invalid-feedback">Please select at least one language.</div>
                                        @error('language_known')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Address & Location --}}
                        <div class="my-3 py-3 card">
                            <div class="mx-3 mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Country<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm country @error('country') is-invalid @enderror"
                                            name="country" value="{{ old('country') }}" readonly required>
                                        <div class="invalid-feedback">Country is required.</div>
                                        @error('country')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">State<span class="text-secondary badge">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm state @error('state') is-invalid @enderror"
                                            name="state" value="{{ old('state') }}" readonly required>
                                        <div class="invalid-feedback">State is required.</div>
                                        @error('state')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">District<span
                                                class="text-secondary badge">*</span></label>
                                        <select name="district"
                                            class="form-select-sm form-select district @error('district') is-invalid @enderror"
                                            required>
                                            <option value="">Select District</option>
                                        </select>
                                        <div class="invalid-feedback">District is required.</div>
                                        @error('district')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mx-3 mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">RTO Division<span
                                                class="text-secondary badge">*</span></label>
                                        <select name="rto[]"
                                            class="form-select-sm form-select rto @error('rto') is-invalid @enderror"
                                            multiple required>
                                        </select>
                                        <div class="invalid-feedback">Please select RTO division(s).</div>
                                        @error('rto')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Pin Code<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="number"
                                            class="form-control form-control-sm @error('pincode') is-invalid @enderror"
                                            name="pincode" value="{{ old('pincode') }}" required>
                                        <div class="invalid-feedback">Please enter pin code.</div>
                                        @error('pincode')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Area<span class="text-secondary badge">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('area') is-invalid @enderror"
                                            name="area" value="{{ old('area') }}" required>
                                        <div class="invalid-feedback">Please enter area.</div>
                                        @error('area')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Address<span
                                                class="text-secondary badge">*</span></label>
                                        <textarea class="form-control Alphanumeric AddressValidation @error('address') is-invalid @enderror" name="address"
                                            required>{{ old('address') }}</textarea>
                                        <div class="invalid-feedback">Please enter address.</div>
                                        @error('address')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn" style="background-color: #260950;color:#fff">Save</button>
                    </form>

                    {{-- Bootstrap Client-side Validation Script --}}
                    <script>
                        (function() {
                            'use strict';
                            var forms = document.querySelectorAll('.needs-validation');
                            Array.prototype.slice.call(forms).forEach(function(form) {
                                form.addEventListener('submit', function(event) {
                                    if (!form.checkValidity()) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.add('was-validated');
                                }, false);
                            });
                        })();
                    </script>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Card header background */
        .card-header-dealer {
            background-color: #260950;
            color: #fff;
            padding: 15px;
        }

        /* Table hover effect */
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        /* Icon button hover effect */
        .btn-icon:hover i {
            transform: scale(1.1);
            transition: 0.2s ease;
        }

        /* Modal Header Styling */
        .modal-header {
            background-color: #260950;
            color: #fff;
        }

        /* Create button */
        .btn-theme {
            background-color: #5a26d1;
            color: white;
        }

        .btn-theme:hover {
            background-color: #440ee6;
            color: #fff;
        }

        /* Table headers */
        .table thead th {
            vertical-align: middle;
        }
    </style>



    <script>
        $(document).ready(function() {
            const AUTH_USER_ID = {{ auth()->user()->id }}; // Pass from server to JS
            let distributorChanged = false;

            // When the distributor is manually changed by the user
            $('.distributor').on('change', function() {
                distributorChanged = true;
                let distributorId = $(this).val();
                fetchDistributorDetails(distributorId);
            });

            // On page load, if distributor hasn't been changed, use auth user ID
            if (!distributorChanged) {
                const initialDistributorId = $('.distributor').val() || AUTH_USER_ID;
                fetchDistributorDetails(initialDistributorId);
            }

            // Function to fetch distributor data
            function fetchDistributorDetails(distributorId) {
                if (distributorId) {
                    $.ajax({
                        url: '/fetch/distributor/details/' + distributorId,
                        type: 'GET',
                        success: function(response) {
                            alert(response);
                            $(".state").val(response.state);
                            $(".country").val(response.country);

                            // $(".district").empty(); // clear previous options
                            response.districts.forEach(district => {
                                $(".district").append(
                                    `<option value="${district}">${district}</option>`
                                );
                            });
                        },
                        error: function() {
                            alert('Error fetching distributor data.');
                        }
                    });
                }
            }
        });
    </script>


@endsection
