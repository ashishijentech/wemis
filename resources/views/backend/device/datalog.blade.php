@extends($layout)
@section('content')
    <div class="conatiner-fluid">
        <div class="align-items-center row"
            style="background: linear-gradient(135deg, #2a0b5a 0%, #1a0638 100%); padding: 12px 20px;box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="me-3 text-white fas fa-map-marked-alt fs-4"></i>
                    <h4 class="mb-0 text-white card-title" style="font-weight: 600; letter-spacing: 0.5px;">Data logs
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <button id="toggleSearch" class="btn btn-primary">Search</button>

        <div id="searchDiv"
            style="display: none; margin-top: 15px; border: 1px solid #0c065c; padding: 15px; border-radius: 5px; background: #f8f9fa;">
            <form action="" method="GET" class="row g-3 align-items-end">

                <!-- From Date -->
                <div class="col-md-5">
                    <label for="from_date" class="form-label fw-bold">From Date</label>
                    <input type="date" name="from_date" id="from_date" class="form-control">
                </div>

                <!-- To Date -->
                <div class="col-md-5">
                    <label for="to_date" class="form-label fw-bold">To Date</label>
                    <input type="date" name="to_date" id="to_date" class="form-control">
                </div>

                <!-- Submit Button -->
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100">Go</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("toggleSearch").addEventListener("click", function() {
            const searchDiv = document.getElementById("searchDiv");
            if (searchDiv.style.display === "none") {
                searchDiv.style.display = "block";
                this.innerText = "Hide Search";
            } else {
                searchDiv.style.display = "none";
                this.innerText = "Search";
            }
        });
    </script>



    <div class="my-2 row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered" border="1" cellpadding="5" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Packet Header</th>
                            <th>Vendor ID</th>
                            <th>Firmware Version</th>
                            <th>Packet Type</th>
                            <th>Alert ID</th>
                            <th>Packet Status</th>
                            <th>IMEI Number</th>
                            <th>Vehicle No</th>
                            <th>GPS Fix</th>
                            <th>Current Date</th>
                            <th>Current Time</th>
                            <th>Latitude</th>
                            <th>Latitude Direction</th>
                            <th>Longitude</th>
                            <th>Longitude Direction</th>
                            <th>Speed</th>
                            <th>Head Degree</th>
                            <th>Satellites</th>
                            <th>Altitude</th>
                            <th>PDOP</th>
                            <th>HDOP</th>
                            <th>Network Operator</th>
                            <th>Ignition Status</th>
                            <th>Mains Power Status</th>
                            <th>Mains Input Voltage</th>
                            <th>Internal Battery Voltage</th>
                            <th>SOS Status</th>
                            <th>Tamper Alert</th>
                            <th>GSM Signal</th>
                            <th>MCC</th>
                            <th>MNC</th>
                            <th>LAC</th>
                            <th>Cell ID</th>
                            <th>NMR1</th>
                            <th>NMR2</th>
                            <th>NMR3</th>
                            <th>NMR4</th>
                            <th>NMR5</th>
                            <th>NMR6</th>
                            <th>NMR7</th>
                            <th>NMR8</th>
                            <th>NMR9</th>
                            <th>NMR10</th>
                            <th>NMR11</th>
                            <th>NMR12</th>
                            <th>Digital Inputs</th>
                            <th>Digital Outputs</th>
                            <th>Analog Input1</th>
                            <th>Frame No</th>
                            <th>Checksum & End</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->packetHeader }}</td>
                                <td>{{ $item->vendorID }}</td>
                                <td>{{ $item->firmwareVersion }}</td>
                                <td>{{ $item->packetType }}</td>
                                <td>{{ $item->alertID }}</td>
                                <td>{{ $item->packetStatus }}</td>
                                <td>{{ $item->IMEINumber }}</td>
                                <td>{{ $item->vehicleNo }}</td>
                                <td>{{ $item->GPSFix }}</td>
                                <td>{{ $item->currentDate }}</td>
                                <td>{{ $item->currentTime }}</td>
                                <td>{{ $item->latitude }}</td>
                                <td>{{ $item->latitudeDirection }}</td>
                                <td>{{ $item->longitude }}</td>
                                <td>{{ $item->longitudeDirection }}</td>
                                <td>{{ $item->speed }}</td>
                                <td>{{ $item->headDegree }}</td>
                                <td>{{ $item->numberofSatellites }}</td>
                                <td>{{ $item->altitude }}</td>
                                <td>{{ $item->PDOP }}</td>
                                <td>{{ $item->HDOP }}</td>
                                <td>{{ $item->networkOperator }}</td>
                                <td>{{ $item->ignitionStatus }}</td>
                                <td>{{ $item->mainsPowerStatus }}</td>
                                <td>{{ $item->mainsInputVoltage }}</td>
                                <td>{{ $item->internalBatteryVoltage }}</td>
                                <td>{{ $item->SOSstatus }}</td>
                                <td>{{ $item->tamperAlert }}</td>
                                <td>{{ $item->GSMSignal }}</td>
                                <td>{{ $item->MCC }}</td>
                                <td>{{ $item->MNC }}</td>
                                <td>{{ $item->LAC }}</td>
                                <td>{{ $item->cellID }}</td>
                                <td>{{ $item->NMR1 }}</td>
                                <td>{{ $item->NMR2 }}</td>
                                <td>{{ $item->NMR3 }}</td>
                                <td>{{ $item->NMR4 }}</td>
                                <td>{{ $item->NMR5 }}</td>
                                <td>{{ $item->NMR6 }}</td>
                                <td>{{ $item->NMR7 }}</td>
                                <td>{{ $item->NMR8 }}</td>
                                <td>{{ $item->NMR9 }}</td>
                                <td>{{ $item->NMR10 }}</td>
                                <td>{{ $item->NMR11 }}</td>
                                <td>{{ $item->NMR12 }}</td>
                                <td>{{ $item->digitalInputs }}</td>
                                <td>{{ $item->digitalOutputs }}</td>
                                <td>{{ $item->analogInput1 }}</td>
                                <td>{{ $item->frameNo }}</td>
                                <td>{{ $item->checksumandEnd }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection
