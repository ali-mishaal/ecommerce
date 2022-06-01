<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\UserModule\Entities\Driver;
use Modules\UserModule\Entities\Government;
use Modules\UserModule\Entities\User;
use Modules\UserModule\Entities\UserAddress;
use Modules\UserModule\Http\Requests\DriverRequest;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Modules\CommonModule\Entities\CompanyVehicle;

class DriversController extends Controller
{
    use UploaderHelper;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $vehicles = CompanyVehicle::get();
        $motos = $vehicles->filter(function ($q) {
            return $q->is_moto;
        });
        $vehicles = $vehicles->filter(function ($q) {
            return !$q->is_moto;
        });

        $roles = Role::all();
        $goverments = Government::all();
        return view('usermodule::driver',compact('vehicles','roles','goverments', 'motos'));
    }

    public function datatables()
    {

        $supervisors = Driver::query()->leftJoin('users', 'drivers.id', '=', 'users.user_id')
            ->where('users.user_type', Driver::class)
            ->select('drivers.*', 'civil_id','mobile','phone','name','address');
        return DataTables::of($supervisors)
            ->addColumn('status', function ($row) {
                $status = $row->user->status==1?'checked':'';
                return '<div class="media mb-2">
                        <div class="media-body text-end icon-state switch-outline">
                          <label class="switch">
                            <input onchange="chageStatus('.$row->user->id.')" type="checkbox" '.$status.' data-bs-original-title="" title="">
                            <span class="switch-state bg-success"></span>
                          </label>
                        </div>
                      </div>';

            })
            ->addColumn('operations', function ($row) {
                return '<div class="dropdown-basic">
                                    <div class="dropdown">
                                        <button class="btn dropbtn btn-primary btn-round dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" onclick="getDriverData('.$row->id.')" href="#" data-toggle="modal"
                                                data-target=".create-driver">
                                                <i class="mdi mdi-square-edit-outline mr-1"></i> ' . trans("lang.edit") . '</a>

                                            <a class="dropdown-item" href="#" data-toggle="modal" onclick="getAccountData('.$row->id.')"
                                                data-target=".user-icon">
                                                <i class="mdi mdi-account-circle-outline mr-1"></i> ' . trans("lang.user") . '</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" onclick="setSupervisorId('.$row->id.')" href="#" data-toggle="modal"
                                                data-target=".popup-delete">
                                                <i class="mdi mdi-delete-outline mr-1"></i>' . trans("lang.delete") . '</a>
                                        </div>
                                    </div>
                                </div>';

            })
            ->rawColumns(['operations' => 'operations','status'=>'status'])

            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DriverRequest $request)
    {

        $data = $request->only('name','civil_id','mobile','phone','address');
        $address = $request->only('addressName','government','region','widget','street','avenue','home_number','floor', 'flat');

        $driverData = $request->only('has_sallary','sallary','has_commission','commission','has_company_vehicle','company_vehicle_id', 'company_moto_id', 'has_moto');


        if ($request->get('driver_id') && (int)$request->get('driver_id') > 0) {

            $user = User::where('id', $request->get('driver_id'))->first();
            if ($request->hasFile('image'))
            {
                $data['image'] = $this->upload($request->file('image'),'drivers');
                $this->deleteFile('drivers', $user->image);
            }

            $user->update($data);
            Driver::where('id',$user->user_id)->update($driverData);
            $message = trans('lang.data_updated');
        } else {
            $data['image'] = $request->hasFile('image') ?  $this->upload($request->file('image'),'drivers') : '';
            $driver = Driver::create($driverData);
            $data['type'] = 3;
            $user = $driver->user()->create($data);
            $address['user_id'] = $user->id;
            $address['name']=$address['addressName'];
            UserAddress::create($address);
            $message = trans('lang.data_saved');
        }
        return \response()->json(['data'=>'done','message'=>$message,'code'=>200]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $admin = Driver::find($id);
        return \response()->json(['data'=>$admin]);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $driver = Driver::find($id);
        $this->deleteFile('drivers', $driver->user->image);
        $driver->user()->delete();
        $driver->delete();
        return \response()->json(['message'=>trans('lang.deleted_message', ['item' => trans('lang.user')])]);
    }
}
