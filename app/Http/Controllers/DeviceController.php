<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\MapDevice;
use App\Models\Distributor;
use App\Models\Dealer;
use App\Models\MapDeviceDetails;
use App\Models\BarCode;
use App\Models\AllocatedBarCode;
use Illuminate\Support\Facades\Auth;
use App\Models\GpsData;


class DeviceController extends Controller
{

    public function map(Request $request)
    {
        $mapDevices = collect();
        $subscriptions = collect();
        $layout = null;
        $distributors = collect();
        $dealers = collect();
        $dealer = null;

        // Manufacturer
        if (Auth::guard('manufacturer')->check()) {
            $manufacturer = Auth::guard('manufacturer')->user();
            $layout = 'layouts.manufacturer';

            $subscriptions = Subscription::where("mfg_id", $manufacturer->id)->get();
            $distributors = Distributor::where('manuf_id', $manufacturer->id)->get();
            $dealerIds = Dealer::whereIn('distributor_id', $distributors->pluck('id'))->pluck('id');

            $mapDevices = MapDeviceDetails::with('barcodes', 'dealer', 'cusmtomer')
                ->whereIn('dealer_id', $dealerIds)
                ->orderby('id', 'desc')
                ->paginate(10);
        }

        // Distributor
        elseif (Auth::guard('distributor')->check()) {
            $distributor = Auth::guard('distributor')->user();
            $layout = 'layouts.distributor';

            $dealers = Dealer::where('distributor_id', $distributor->id)->get();
            $dealerIds = $dealers->pluck('id');

            $mapDevices = MapDeviceDetails::with('barcodes', 'dealer')
                ->whereIn('dealer_id', $dealerIds)
                ->get();

            $subscriptions = Subscription::where("mfg_id", $distributor->manuf_id)->get();
        }

        // Dealer
        elseif (Auth::guard('dealer')->check()) {
            $dealer = Auth::guard('dealer')->user();
            $layout = 'layouts.dealer';

            $mapDevices = MapDeviceDetails::with('barcodes', 'dealer', 'cusmtomer')
                ->where('dealer_id', $dealer->id)
                ->get();

            $subscriptions = Subscription::where("mfg_id", $dealer->distributor->manuf_id)->get();
        }

        // Technician
        elseif (Auth::guard('technician')->check()) {
            $technician = Auth::guard('technician')->user();
            $layout = 'layouts.technician';

            $dealer = Dealer::find($technician->dealer_id);

            $mapDevices = MapDeviceDetails::with('barcodes', 'dealer', 'cusmtomer')
                ->where('dealer_id', $dealer->id)
                ->get();

            $subscriptions = Subscription::where("mfg_id", $dealer->distributor->manuf_id)->get();
        }

        // No access
        else {
            abort(403, 'Unauthorized');
        }

        return view('backend.device.map', compact(
            'subscriptions',
            'mapDevices',
            'layout',
            'dealers',
            'dealer',
            'distributors'
        ));
    }



    public function store(Request $request)
    {

        $request->validate(
            [

                'customerName' => 'required|string|max:50',
                'customerEmail' => 'required|email|max:50',
                'customerMobile' => 'required',
                'state' => 'required',
                'coustomerDistrict' => 'required',
                'coustomerPincode' => 'required',
                'coustomeraddress' => 'required',
                'rto_devision' => 'required',
                'dealer' => 'required',
                'subscriptionpackage' => 'required',
                'deviceType' => 'required',
                'deviceNo' => 'required',
                'vehicleBirth' => 'required',
                'regNumber' => 'required',
                'regdate' => 'required',
                'chassisNumber' => 'required',
                'engineNumber' => 'required',
                'vehicleType' => 'required',
                'vaiclemodel' => 'required',
                'vaimodelyear' => 'required',
                'vaicleinsurance' => 'required',
                'pollutiondate' => 'required',
                'technician' => 'required',
                'InvoiceNo' => 'required',
                'VehicleKMReading' => 'required',
                'DriverLicenseNo' => 'required',
                'MappedDate' => 'required',
                'NoOfPanicButtons' => 'required',
                'vehicleimg' => '',
                'vehiclerc' => '',
                'vaicledeviceimg' => '',
                'pancardimg' => '',
                'aadharcardimg' => '',
                'invoiceimg' => '',
                'signatureimg' => '',
                'panicbuttonimg' => '',

            ],
        );
        try {
            $user = MapDevice::where('customer_email', $request['customerEmail'])->orWhere('customer_mobile', $request['customerMobile'])->first();
            if ($user != null) {
                $user_id = $user->id;
            } else {
                $mapDevice = new MapDevice();
                $mapDevice->customer_name = $request['customerName'];
                $mapDevice->customer_email = $request['customerEmail'];
                $mapDevice->password = $request['customerMobile'];
                $mapDevice->passwordText = $request['customerMobile'];
                $mapDevice->customer_mobile = $request['customerMobile'];
                $mapDevice->customer_gst_no = $request['customergstin'];
                $mapDevice->customer_state = $request['state'];
                $mapDevice->customer_district = $request['coustomerDistrict'];
                $mapDevice->customer_arear = $request['coustomerArea'];
                $mapDevice->customer_pincode = $request['coustomerPincode'];
                $mapDevice->customer_address = $request['coustomeraddress'];
                $mapDevice->customer_rto_division = $request['rto_devision'];
                $mapDevice->customer_aadhaar = $request['customeraadhar'];
                $mapDevice->customer_pan = $request['customerpanno'];
                $mapDevice->save();
                $user_id = $mapDevice->id;
            }

            $deviceDetails = new MapDeviceDetails();
            $deviceDetails->mapDevice_id = $user_id;
            $deviceDetails->dealer_id = $request['dealer'];
            $deviceDetails->package_id = $request['subscriptionpackage'];
            $deviceDetails->device_type = $request['deviceType'];
            $deviceDetails->device_seriel_no = $request['deviceNo'];
            $deviceDetails->vehicle_birth = $request['vehicleBirth'];
            $deviceDetails->vehicle_registration_number = $request['regNumber'];
            $deviceDetails->date = $request['regdate'];
            $deviceDetails->vehicle_chassis_no = $request['chassisNumber'];
            $deviceDetails->vehicle_engine_no = $request['engineNumber'];
            $deviceDetails->vehicle_type = $request['vehicleType'];
            $deviceDetails->vehicle_make_model = $request['vaiclemodel'];
            $deviceDetails->vehicle_model_year = $request['vaimodelyear'];
            $deviceDetails->vehicle_insurance_renew_date = $request['vaicleinsurance'];
            $deviceDetails->vehicle_pollution_renew_date = $request['pollutiondate'];
            $deviceDetails->technician_id = $request['technician'];
            $deviceDetails->invoice_no = $request['InvoiceNo'];
            $deviceDetails->vehicle_km_reading = $request['VehicleKMReading'];
            $deviceDetails->driver_license_no = $request['DriverLicenseNo'];
            $deviceDetails->mapped_date = $request['MappedDate'];
            $deviceDetails->no_of_panic_buttons = $request['NoOfPanicButtons'];
            if ($request['vehicleimg'] != null) {
                $uploadedFileName = uploadFile($request["vehicleimg"], 'vehicleimg');
                // $manufacturer->logo = $uploadedFileName;

                // $vehicleimgfilePath = $request->file('vehicleimg')->store('uploads', 'private');
                $deviceDetails->vehicle = $uploadedFileName;
            }
            if ($request['vehiclerc'] != null) {
                $uploadedFileName = uploadFile($request["vehiclerc"], 'vehiclerc');

                // $vehiclercfilePath = $request->file('vehiclerc')->store('uploads', 'private');
                $deviceDetails->rc = $uploadedFileName;
            }

            if ($request['vaicledeviceimg'] != null) {
                $uploadedFileName = uploadFile($request["vaicledeviceimg"], 'vaicledeviceimg');

                // $vaicledeviceimgfilePath = $request->file('vaicledeviceimg')->store('uploads', 'private');
                $deviceDetails->device = $uploadedFileName;
            }

            if ($request['pancardimg'] != null) {
                $uploadedFileName = uploadFile($request["pancardimg"], 'pancardimg');

                // $pancardimgfilePath = $request->file('pancardimg')->store('uploads', 'private');
                $deviceDetails->pan = $uploadedFileName;
            }

            if ($request['aadharcardimg'] != null) {
                $uploadedFileName = uploadFile($request["pancardimg"], 'pancardimg');

                // $aadhaarfilePath = $request->file('aadharcardimg')->store('uploads', 'private');
                $deviceDetails->aadhaar = $uploadedFileName;
            }
            if ($request['invoiceimg'] != null) {
                $uploadedFileName = uploadFile($request["invoiceimg"], 'invoiceimg');

                // $invoiceimgfilePath = $request->file('invoiceimg')->store('uploads', 'private');
                $deviceDetails->invoice = $uploadedFileName;
            }
            if ($request['signatureimg'] != null) {
                $uploadedFileName = uploadFile($request["signatureimg"], 'signatureimg');

                // $signatureimgfilePath = $request->file('signatureimg')->store('uploads', 'private');
                $deviceDetails->signature = $uploadedFileName;
            }
            if ($request['panicbuttonimg'] != null) {
                $uploadedFileName = uploadFile($request["panicbuttonimg"], 'panicbuttonimg');

                // $panicbuttonimgfilePath = $request->file('panicbuttonimg')->store('uploads', 'private');
                $deviceDetails->panic_button = $uploadedFileName;
            }
            $deviceDetails->save();
            $barcode = BarCode::find($request['deviceNo']);
            $barcode->status = '2';
            $barcode->save();
            $allocatedBarcode = AllocatedBarCode::where('barcode_id', $request['deviceNo'])->first();
            $status = AllocatedBarCode::find($allocatedBarcode->id);
            $status->status = '1';
            $status->save();
            return redirect()->back()->with('success', 'Device Mapped successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }



    public function dataLog($deviceId, Request $request)
    {
        if (Auth::guard('manufacturer')->check()) {
            $layout = 'layouts.manufacturer';
        } elseif (Auth::guard('distributor')->check()) {
            $layout = 'layouts.distributor';
        } elseif (Auth::guard('dealer')->check()) {
            $layout = 'layouts.dealer';
        } elseif (Auth::guard('technician')->check()) {
            $layout = 'layouts.technician';
        } else {
            abort(403, 'Unauthorized');
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $data = GpsData::where('IMEINumber', $deviceId)
                ->whereBetween('created_at', [
                    $request->from_date . " 00:00:00",
                    $request->to_date . " 23:59:59"
                ])
                ->orderBy('id', 'desc')
                ->paginate(100);
        } else {
            $data = GpsData::where('IMEINumber', $deviceId)
                ->orderBy('id', 'desc')
                ->paginate(100);
        }

        return view('backend.device.datalog', compact('data', 'layout'));
    }

    public function documents($deviceId)
    {
        if (Auth::guard('manufacturer')->check()) {
            $layout = 'layouts.manufacturer';
        } elseif (Auth::guard('distributor')->check()) {
            $layout = 'layouts.distributor';
        } elseif (Auth::guard('dealer')->check()) {
            $layout = 'layouts.dealer';
        } elseif (Auth::guard('technician')->check()) {
            $layout = 'layouts.technician';
        } else {
            abort(403, 'Unauthorized');
        }
        $device = MapDeviceDetails::where('id', $deviceId)->first();
        // dd($device);
        return view('backend.device.documents', compact('device', 'layout'));
    }

    public function tracking($imei)
    {
        return view('backend.tracking.livelocation')->with(compact('imei'));
    }
    public function latestLocation($imei)
    {
        $latest = GpsData::where('IMEINumber', $imei)
            ->orderBy('id', 'desc')
            ->first();

        if (!$latest) {
            return response()->json(['error' => 'No location data found'], 404);
        }

        return response()->json([
            'latitude' => $latest->latitude,
            'longitude' => $latest->longitude,
            'speed' => $latest->speed,
            'timestamp' => $latest->created_at,
        ]);
    }

    public function edit($deviceId)
    {
        if (Auth::guard('manufacturer')->check()) {
            $layout = 'layouts.manufacturer';
            $subscriptions = Subscription::where('mfg_id', auth('manufacturer')->user()->id)->get();
            $device = MapDeviceDetails::with('barcodes', 'dealer', 'cusmtomer', 'dealer.distributor')->where('id', $deviceId)->first();
            return view('backend.device.edit', compact('device', 'subscriptions', 'layout'));
        } elseif (Auth::guard('distributor')->check()) {
            $layout = 'layouts.distributor';
        } elseif (Auth::guard('dealer')->check()) {
            $layout = 'layouts.dealer';
        } elseif (Auth::guard('technician')->check()) {
            $layout = 'layouts.technician';
        } else {
            abort(403, 'Unauthorized');
        }
    }


    public function update(Request $request, $deviceId)
    {


        // $mapDevice = MapDevice::find($deviceId);
        // $mapDevice->customer_name = $request['customerName'];
        // $mapDevice->customer_email = $request['customerEmail'];
        // $mapDevice->password = $request['customerMobile'];
        // $mapDevice->passwordText = $request['customerMobile'];
        // $mapDevice->customer_mobile = $request['customerMobile'];
        // $mapDevice->customer_gst_no = $request['customergstin'];
        // $mapDevice->customer_state = $request['state'];
        // $mapDevice->customer_district = $request['coustomerDistrict'];
        // $mapDevice->customer_arear = $request['coustomerArea'];
        // $mapDevice->customer_pincode = $request['coustomerPincode'];
        // $mapDevice->customer_address = $request['coustomeraddress'];
        // $mapDevice->customer_rto_division = $request['rto_devision'];
        // $mapDevice->customer_aadhaar = $request['customeraadhar'];
        // $mapDevice->customer_pan = $request['customerpanno'];
        // $mapDevice->save();
        // $user_id = $mapDevice->id;


        $deviceDetails = MapDeviceDetails::find($deviceId);
        // $deviceDetails->mapDevice_id = $user_id;
        $deviceDetails->dealer_id = $request['dealer'];
        $deviceDetails->package_id = $request['subscriptionpackage'];
        $deviceDetails->device_type = $request['deviceType'];
        $deviceDetails->device_seriel_no = $request['deviceNo'];
        $deviceDetails->vehicle_birth = $request['vehicleBirth'];
        $deviceDetails->vehicle_registration_number = $request['regNumber'];
        $deviceDetails->date = $request['regdate'];
        $deviceDetails->vehicle_chassis_no = $request['chassisNumber'];
        $deviceDetails->vehicle_engine_no = $request['engineNumber'];
        $deviceDetails->vehicle_type = $request['vehicleType'];
        $deviceDetails->vehicle_make_model = $request['vaiclemodel'];
        $deviceDetails->vehicle_model_year = $request['vaimodelyear'];
        $deviceDetails->vehicle_insurance_renew_date = $request['vaicleinsurance'];
        $deviceDetails->vehicle_pollution_renew_date = $request['pollutiondate'];
        $deviceDetails->technician_id = $request['technician'];
        $deviceDetails->invoice_no = $request['InvoiceNo'];
        $deviceDetails->vehicle_km_reading = $request['VehicleKMReading'];
        $deviceDetails->driver_license_no = $request['DriverLicenseNo'];
        $deviceDetails->mapped_date = $request['MappedDate'];
        $deviceDetails->no_of_panic_buttons = $request['NoOfPanicButtons'];
        if ($request['vehicleimg'] != null) {
            $uploadedFileName = uploadFile($request["vehicleimg"], 'vehicleimg');
            // $manufacturer->logo = $uploadedFileName;

            // $vehicleimgfilePath = $request->file('vehicleimg')->store('uploads', 'private');
            $deviceDetails->vehicle = $uploadedFileName;
        }
        if ($request['vehiclerc'] != null) {
            $uploadedFileName = uploadFile($request["vehiclerc"], 'vehiclerc');

            // $vehiclercfilePath = $request->file('vehiclerc')->store('uploads', 'private');
            $deviceDetails->rc = $uploadedFileName;
        }

        if ($request['vaicledeviceimg'] != null) {
            $uploadedFileName = uploadFile($request["vaicledeviceimg"], 'vaicledeviceimg');

            // $vaicledeviceimgfilePath = $request->file('vaicledeviceimg')->store('uploads', 'private');
            $deviceDetails->device = $uploadedFileName;
        }

        if ($request['pancardimg'] != null) {
            $uploadedFileName = uploadFile($request["pancardimg"], 'pancardimg');

            // $pancardimgfilePath = $request->file('pancardimg')->store('uploads', 'private');
            $deviceDetails->pan = $uploadedFileName;
        }

        if ($request['aadharcardimg'] != null) {
            $uploadedFileName = uploadFile($request["pancardimg"], 'pancardimg');

            // $aadhaarfilePath = $request->file('aadharcardimg')->store('uploads', 'private');
            $deviceDetails->aadhaar = $uploadedFileName;
        }
        if ($request['invoiceimg'] != null) {
            $uploadedFileName = uploadFile($request["invoiceimg"], 'invoiceimg');

            // $invoiceimgfilePath = $request->file('invoiceimg')->store('uploads', 'private');
            $deviceDetails->invoice = $uploadedFileName;
        }
        if ($request['signatureimg'] != null) {
            $uploadedFileName = uploadFile($request["signatureimg"], 'signatureimg');

            // $signatureimgfilePath = $request->file('signatureimg')->store('uploads', 'private');
            $deviceDetails->signature = $uploadedFileName;
        }
        if ($request['panicbuttonimg'] != null) {
            $uploadedFileName = uploadFile($request["panicbuttonimg"], 'panicbuttonimg');

            // $panicbuttonimgfilePath = $request->file('panicbuttonimg')->store('uploads', 'private');
            $deviceDetails->panic_button = $uploadedFileName;
        }
        $deviceDetails->save();
        $barcode = BarCode::find($request['deviceNo']);
        $barcode->status = '2';
        $barcode->save();
        $allocatedBarcode = AllocatedBarCode::where('barcode_id', $request['deviceNo'])->first();
        $status = AllocatedBarCode::find($allocatedBarcode->id);
        $status->status = '1';
        $status->save();
        return redirect()->route('map.device')->with('success', 'Device Edited successfully!');
    }

    public function view($deviceId)
    {
        if (Auth::guard('manufacturer')->check()) {
            $layout = 'layouts.manufacturer';
            $device = MapDeviceDetails::with('barcodes', 'dealer', 'cusmtomer', 'dealer.distributor')->where('id', $deviceId)->first();
            return view('backend.device.view', compact('device', 'layout'));
        } elseif (Auth::guard('distributor')->check()) {
            $layout = 'layouts.distributor';
        } elseif (Auth::guard('dealer')->check()) {
            $layout = 'layouts.dealer';
        } elseif (Auth::guard('technician')->check()) {
            $layout = 'layouts.technician';
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
