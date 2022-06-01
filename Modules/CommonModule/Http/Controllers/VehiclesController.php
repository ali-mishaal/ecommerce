<?php

namespace Modules\CommonModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\CommonModule\Entities\CompanyVehicle;
use Modules\CommonModule\Http\Requests\VehiclesRequest;
use Modules\TransferModule\Entities\Brand;
use Modules\TransferModule\Entities\VehicleType;
use Yajra\DataTables\DataTables;

class VehiclesController extends Controller
{
    use UploaderHelper;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         $brands = Brand::all();
         $VehicleTypes = VehicleType::all();
        return view('commonmodule::vehicles',compact('brands','VehicleTypes'));
    }

    public function datatables()
    {
        $supervisors = CompanyVehicle::query()->with(['brand','vehicleType']);
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
                                                <i class="mdi mdi-delete-outline mr-1"></i>' . trans("lang.delete") .'</a>
                                        </div>
                                    </div>
                                </div>';

            })
            ->rawColumns(['operations' => 'operations'])

            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(VehiclesRequest $request)
    {

        $vehicleData = $request->only('brand','color','vehicle_number','type','system_number', 'is_moto');

        if ($request->get('vehicle_id') && (int)$request->get('vehicle_id') > 0) {

            CompanyVehicle::where('id',$request->get('vehicle_id'))->update($vehicleData);
            $message = trans('lang.data_updated');
        } else {
            $vehicle = CompanyVehicle::create($vehicleData);
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
        $admin = CompanyVehicle::find($id);
        return \response()->json(['data'=>$admin]);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {

        CompanyVehicle::where('id',$id)->delete();

        return \response()->json(['message'=> trans('lang.deleted_message', ['item' => trans('lang.user')])]);
    }
}
