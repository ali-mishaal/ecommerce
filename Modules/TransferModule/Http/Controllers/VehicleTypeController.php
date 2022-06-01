<?php

namespace Modules\TransferModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Entities\CompanyVehicle;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\TransferModule\Entities\DriverVehicle;
use Modules\TransferModule\Entities\TransferVehicle;
use Modules\TransferModule\Entities\VehicleType;
use Modules\TransferModule\Http\Requests\VehiclesDriverRequest;
use Modules\UserModule\Entities\Driver;
use Yajra\DataTables\DataTables;

class VehicleTypeController extends Controller
{
    use UploaderHelper;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        return view('transfermodule::vehicle-type');
    }

    public function datatables()
    {
        $supervisors = VehicleType::query()->orderBy('updated_at', 'desc');
        return DataTables::of($supervisors)
            ->addColumn('operations', function ($row) {
                return '<div class="dropdown-basic">
                                    <div class="dropdown">
                                        <button class="btn dropbtn btn-primary btn-round dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" onclick="getVehicleData('.$row->id.')" href="#" data-toggle="modal"
                                                data-target=".create-vehicle">
                                                <i class="mdi mdi-square-edit-outline mr-1"></i>' . trans("lang.edit") . '</a>

                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" onclick="setSupervisorId('.$row->id.')" href="#" data-toggle="modal"
                                                data-target=".popup-delete">
                                                <i class="mdi mdi-delete-outline mr-1"></i>'. trans("lang.delete") .'</a>
                                        </div>
                                    </div>
                                </div>';

            })
            ->rawColumns(['operations' => 'operations'])

            ->toJson();
    }

    public function store(VehiclesDriverRequest $request)
    {
        $vehicleData = $request->only('name_ar','name_en');

        if ($request->get('vehicle_type_id') && (int)$request->get('vehicle_type_id') > 0) {

            VehicleType::where('id',$request->get('vehicle_type_id'))->update($vehicleData);
            $message = trans('lang.data_updated');
        } else {
            $vehicle = VehicleType::create($vehicleData);
            $message = trans('lang.data_saved');
        }
        return \response()->json(['data'=>'done','message'=>$message,'code'=>200]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $admin = VehicleType::find($id);
        return \response()->json(['data'=>$admin]);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {

        VehicleType::where('id',$id)->delete();
        return \response()->json(['message'=> trans('lang.deleted_message', ['item' => trans('lang.vehicle_type')])]);
    }

    public function changeVehicle($id,$vehicle="")
    {
        $vehiclesAll = DriverVehicle::where('driver_id',$id)->get()->pluck('vehicle_id')->toArray();
        $vehicles = CompanyVehicle::whereIn('id',$vehiclesAll)->get();
        $result = '<option value="">' . trans('lang.choose...') . '</option>';
        foreach($vehicles as $key){
            $selected = $key->id==$vehicle?'selected':'';
            $result .= "<option ".$selected." value='".$key->id."'>".$key->vehicle_number."</option>";
        }

        return $result;
    }
}
