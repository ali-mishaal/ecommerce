<?php

namespace Modules\TransferModule\Http\Controllers;

use App\DataTables\TransferVehicleDataTable;
use App\Rules\CheckKmNuber;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Entities\CompanyVehicle;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\TransferModule\Entities\DriverVehicle;
use Modules\TransferModule\Entities\TransferVehicle;
use Modules\TransferModule\Http\Requests\VehiclesDriverRequest;
use Modules\UserModule\Entities\Driver;
use Yajra\DataTables\DataTables;

class TransferVehicleController extends Controller
{
    use UploaderHelper;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(TransferVehicleDataTable $transferVehicleDataTable)
    {
        $driversHasCar = DriverVehicle::groupBy('driver_id')->get()->pluck('driver_id')->toArray();

        $myVehicles = null;
        if(auth()->user()->hasRole('driver'))
        {
            $drivers = Driver::where('id', '!=', auth()->user()->user_id)->with('user')->get();
            $oldDriver = Driver::whereIn('id',$driversHasCar)->where('id', '!=', auth()->user()->user_id)->get();
            $myVehicles =  driverVehicle::where('driver_id', auth()->user()->user_id)->get();
        }else
        {
            $drivers = Driver::with('user')->get();
            $oldDriver = Driver::whereIn('id',$driversHasCar)->get();
        }

        return  $transferVehicleDataTable
            ->with(['driver_filter' => auth()->user()->hasRole('driver') ? auth()->user()->user_id : null ])
            ->render('transfermodule::transfer-vehicle', compact('drivers', 'oldDriver', 'myVehicles'));

    }


    public function store(VehiclesDriverRequest $request)
    {
        $request->validate([
            'request_km'=>[
                'required',
                'numeric',
                'min:0',
                new CheckKmNuber($request->get('vehicle_id'))
            ]
        ]);


        $vehicleData = $request->only('vehicle_id','driver_id','old_driver_id','request_km','deduction','request_note');
        $vehicleData['created_by_id'] = auth()->user()->user_id;
        $vehicleData['created_by_type'] = auth()->user()->user_type;

        if(auth()->user()->hasRole('driver') )
        {
            if($request->old_driver_id == auth()->user()->user_id)
            {
                $vehicleData['old_driver_status'] = true;
            }elseif($request->driver_id == auth()->user()->user_id){
                $vehicleData['driver_status'] = true;
            }
        }elseif(auth()->user()->hasAnyRole(['supervisor', 'admin'])){
            $vehicleData['supervisor_status'] = true;
        }

        if ($request->hasFile('request_km_image'))
            $vehicleData['request_km_image'] = $this->upload($request->file('request_km_image'),'transfer-vehicles');
        if ($request->hasFile('request_vehicle_image'))
            $vehicleData['request_vehicle_image'] = $this->upload($request->file('request_vehicle_image'),'transfer-vehicles');

        $vehicleData['deduction'] = $request->deduction ?? 0;
        TransferVehicle::create($vehicleData);
        return \response()->json(['data'=>'done','message'=> trans('lang.data_saved'),'code'=>200]);
    }

    public function getData($id)
    {
        $vehicleData = TransferVehicle::where('id', $id)->with('vehicle')->first();

        $data = 'there is no such a record';
        $status = 404;
        if($vehicleData)
        {
            $is_old_driver = auth()->user()->hasRole('driver') && auth()->user()->user_id == $vehicleData->old_driver_id;
            $is_new_driver = auth()->user()->hasRole('driver') && auth()->user()->user_id == $vehicleData->driver_id;
            $data = $vehicleData;
            $data->is_old_driver = $is_old_driver;
            $data->is_new_driver = $is_new_driver;
            $status = 200;
        }

        return response()->json(['data' => $data], $status);

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function approve(Request $request, $id)
    {
        $transferVehicle = TransferVehicle::find($id);
        if(!$transferVehicle)
        {
            return response()->json(['error' => 'there is no such request'], 404);
        }

        if(!auth()->user()->hasRole('driver'))
        {
            $transferVehicle->supervisor_status = true;
            $transferVehicle->save();
            $transferVehicle->onApprove();
            return response()->json(['data'=>'done','message'=>'data saved successfully','code'=>200]);
        }elseif($transferVehicle->old_driver_id == auth()->user()->user_id){
            $transferVehicle->old_driver_status = true;
            $transferVehicle->save();
            $transferVehicle->onApprove();
            return response()->json(['data'=>'done','message'=> trans('lang.data_saved'),'code'=>200]);
        };



        $request->validate([
            'driver_plate_image' => ['required', 'image'],
            'driver_km_image'   => ['required', 'image'],
            'terms'             => ['accepted']
        ]);




        $driver_plate_image = $this->upload($request->file('driver_plate_image'),'transfer-vehicles');
        $driver_km_image = $this->upload($request->file('driver_km_image'),'transfer-vehicles');

        $transferVehicle->update([
            'driver_plate_image' => $driver_plate_image,
            'driver_km_image' => $driver_km_image,
            'driver_status'     => true
        ]);
        $transferVehicle->onApprove();
        return response()->json(['data'=>'done','message'=>trans('lang.data_saved'),'code'=>200]);
    }


    public function revert(Request $request, $id): JsonResponse
    {
        $transferVehicle = TransferVehicle::find($id);

        if(!$transferVehicle)
        {
            return response()->json(['error' => 'there is no such request'], 404);
        }


        $request->validate([
            'driver_plate_image' => ['required_with:driver_km_image', 'image'],
            'driver_km_image'   => ['required_with:driver_plate_image', 'image'],
            'revert_km_image' => ['required_without:driver_plate_image,driver_km_image', 'image'],
            'revert_request_km'=>[
                'required',
                'numeric',
                'min:0',
                new CheckKmNuber($transferVehicle->vehicle_id)
            ]
        ]);

        $isDriver = auth()->user()->hasRole('driver');
        $user_id = auth()->user()->user_id;

        $driver_status = false;
        $supervisor_status = false;
        $old_driver_status = false;

        if ($isDriver  && $transferVehicle->driver_id == $user_id)
        {
            $driver_status = true;
            $request_km_image = $this->upload($request->file('driver_km_image'),'transfer-vehicles');
            $driver_plate_image = $this->upload($request->file('driver_plate_image'),'transfer-vehicles');


        }else{
            if($isDriver  && $transferVehicle->old_driver_id == $user_id)
            {
                $old_driver_status = true;


            }elseif(!$isDriver)
            {
                $supervisor_status = true;
            }

            $request_km_image = $this->upload($request->file('revert_km_image'),'transfer-vehicles');
        }

        $transferVehicle->update([
            'driver_plate_image' => $driver_plate_image ?? null,
            'request_km_image' => $request_km_image,
            'driver_status'     => $driver_status,
            'supervisor_status' => $supervisor_status,
            'old_driver_status' => $old_driver_status,
            'request_km'        => $request->revert_request_km,
        ]);

        return response()->json(['data'=>'done','message'=> trans('lang.data_saved'),'code'=>200]);

    }

    public function getDriversExcept($id): JsonResponse
    {
        $data = Driver::where('id', '!=', $id)->with('user')->get();
        $data = $data->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->user->name
            ];
        });

        return response()->json(['data'=>$data ,'code'=>200]);
    }
}
