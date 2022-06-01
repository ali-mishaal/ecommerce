<?php

namespace Modules\TransferModule\Http\Controllers;

use App\DataTables\AttachVehicleDataTable;
use App\Rules\CheckKmNuber;
use http\Env\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Entities\CompanyVehicle;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\TransferModule\Entities\AttachVehicle;
use Modules\UserModule\Entities\Driver;

class AttachVehicleController extends Controller
{
    use UploaderHelper;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(AttachVehicleDataTable $attachVehicleDataTable)
    {
        $vehicles = CompanyVehicle::Has('driver', 0)->get();
        $drivers = Driver::all();
        return  $attachVehicleDataTable
            ->with(['driver_filter' => auth()->user()->hasRole('driver') ? auth()->user()->user_id : null ])
            ->render('transfermodule::attach-vehicle', compact('vehicles', 'drivers'));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'request_km'=>[
                'required',
                'numeric',
                'min:0',
                new CheckKmNuber($request->get('vehicle_id'))
            ]
        ]);
        $AttachData = $request->only('vehicle_id', 'driver_id', 'request_km', 'request_note');
        $AttachData['created_by_id'] = auth()->user()->user_id;
        $AttachData['created_by_type'] = auth()->user()->user_type;

        if(auth()->user()->hasRole('driver'))
        {
            $AttachData['driver_status'] = true;
            $AttachData['driver_id'] = auth()->user()->user_id;
        }else{
            $AttachData['supervisor_status'] = true;
        }

        if ($request->hasFile('request_vehicle_image'))
            $AttachData['request_vehicle_image'] = $this->upload($request->file('request_vehicle_image'),'attach-vehicles');
        if ($request->hasFile('request_km_image'))
            $AttachData['request_km_image'] = $this->upload($request->file('request_km_image'),'attach-vehicles');

        AttachVehicle::Create($AttachData);
        $message = trans('lang.data_saved');




        return response()->json(['data'=>'done','message'=>$message,'code'=>200]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */

    public function getData($id)
    {
        $vehicleData = AttachVehicle::where('id', $id)->with('vehicle')->first();

        $data = trans('lang.no_record');
        $status = 404;
        if($vehicleData)
        {
            $data = $vehicleData;
            $status = 200;
        }

        return response()->json(['data' => $data], $status);

    }

    public function approve(Request $request, $id)
    {
        $attachVehicle = AttachVehicle::find($id);

        if(!auth()->user()->hasRole('driver'))
        {
            $attachVehicle->supervisor_status = true;
            $attachVehicle->save();
            $attachVehicle->onApprove();
            return response()->json(['data'=>'done','message'=> trans('lang.data_saved'),'code'=>200]);
        }
        $request->validate([
            'driver_plate_image' => ['required', 'image'],
            'driver_km_image'   => ['required', 'image'],
            'terms'             => ['accepted']
        ]);


        if(!$attachVehicle)
        {
            return response()->json(['error' => trans('lang.no_request')], 404);
        }

        $driver_plate_image = $this->upload($request->file('driver_plate_image'),'attach-vehicles');
        $driver_km_image = $this->upload($request->file('driver_km_image'),'attach-vehicles');

        $attachVehicle->update([
            'driver_plate_image' => $driver_plate_image,
            'driver_km_image' => $driver_km_image,
            'driver_status'     => true
        ]);
        $attachVehicle->onApprove();
        return response()->json(['data'=>'done','message'=> trans('lang.data_saved'),'code'=>200]);
    }


    public function revert(Request $request, $id): JsonResponse
    {
        $attachVehicle = AttachVehicle::find($id);

        if(!$attachVehicle)
        {
            return response()->json(['error' => trans('lang.no_request')], 404);
        }


        $request->validate([
            'driver_plate_image' => ['required_with:driver_km_image', 'image'],
            'driver_km_image'   => ['required_with:driver_plate_image', 'image'],
            'supervisor_km_image' => ['required_without:driver_plate_image,driver_km_image', 'image'],
            'revert_request_km'=>[
                'required',
                'numeric',
                'min:0',
                new CheckKmNuber($attachVehicle->vehicle_id)
            ]
        ]);


        if (!auth()->user()->hasRole('driver'))
        {
            $supervisor_status = true;
            $driver_status = false;
            $request_km_image = $this->upload($request->file('supervisor_km_image'),'attach-vehicles');
        }else{
            $driver_status = true;
            $supervisor_status = false;
            $request_km_image = $this->upload($request->file('driver_km_image'),'attach-vehicles');
            $driver_plate_image = $this->upload($request->file('driver_plate_image'),'attach-vehicles');
        }

        $attachVehicle->update([
            'driver_plate_image' => $driver_plate_image ?? null,
            'request_km_image' => $request_km_image,
            'driver_status'     => $driver_status,
            'supervisor_status' => $supervisor_status,
            'request_km'        => $request->revert_request_km,
        ]);

        return response()->json(['data'=>'done','message'=> trans('lang.created_message', ['item' => trans('lang.request')]),'code'=>200]);

    }
}
