<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
    <div class="card" style="width: 100%;">
        <div class="card-header">
            <h5 class="mb-0">Customer Details</h5>
        </div>
        <div class="card-body">
            <h6 class="card-title">Customer Information</h6>
            <p class="card-text">Detailed information about the customer associated with this device.</p>
            <table class="table table-bordered" style="width:100%">
                <tbody>
                    <tr>
                        <th scope="row">Customer Name</th>
                        <td>{{ $device->cusmtomer->customer_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        {{-- <th scope="row">Contact Person</th>
                <td>{{ $device->cusmtomer->contact_person ?? 'N/A' }}</td> --}}
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td>{{ $device->cusmtomer->customer_email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone</th>
                        <td>{{ $device->cusmtomer->customer_mobile ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Address</th>
                        <td>{{ $device->cusmtomer->customer_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">District</th>
                        <td>{{ $device->cusmtomer->customer_district ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">State</th>
                        <td>{{ $device->cusmtomer->customer_state ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Country</th>
                        <td>{{ $device->cusmtomer->country ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">RTO Devision</th>
                        <td>{{ $device->cusmtomer->customer_rto_division ?? 'N/A' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
