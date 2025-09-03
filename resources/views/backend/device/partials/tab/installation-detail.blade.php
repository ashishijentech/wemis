 <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"
                tabindex="0">
    <div class="card" style="width: 100%;">
        <div class="card-header">
            <h5 class="mb-0">Installation Detail</h5>
        </div>
        <div class="card-body">
            <h6 class="card-title">Installation Information</h6>
            <p class="card-text">Detailed information about the installation associated with this device.</p>
            <table class="table table-bordered" style="width:100%">
                <tbody>
                    <tr>
                        <th scope="row">Invoice No.</th>
                        <td>{{ $device->invoice_no ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Vehicle KM  Reading</th>
                        <td>{{ $device->vehicle_km_reading ?? 'N/A' }} km</td>
                    </tr>
                    <tr>
                        <th scope="row">Driver License No.</th>
                        <td>{{ $device->driver_license_no ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Date</th>
                        <td>{{ $device->mapped_date ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">No. Of Panic Button</th>
                        <td>{{ $device->no_of_panic_buttons ?? 'N/A' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>