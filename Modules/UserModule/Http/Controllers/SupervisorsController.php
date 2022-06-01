<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\UserModule\Entities\Government;
use Modules\UserModule\Entities\Supervisor;
use Modules\UserModule\Entities\User;
use Modules\UserModule\Entities\UserAddress;
use Modules\UserModule\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class SupervisorsController extends Controller
{
    use UploaderHelper;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $goverments = Government::all();
        $roles = Role::all();
        return view('usermodule::supervisor',compact('roles','goverments'));
    }

    public function datatables()
    {
        $supervisors = Supervisor::query()->leftJoin('users', 'supervisors.id', '=', 'users.user_id')
        ->where('users.user_type', Supervisor::class)
        ->select('supervisors.*', 'civil_id','mobile','name','address');
        return DataTables::of($supervisors)
            ->addColumn('status', function ($row) {
                $status = $row->user->status==1?'checked':'';
                return '<div class="media mb-2">
                        <div class="media-body text-end icon-state switch-outline">
                          <label class="switch">
                            <input onchange="chageStatus('.$row->user->id.')" type="checkbox"  '.$status.' data-bs-original-title="" title="">
                            <span class="switch-state bg-success"></span>
                          </label>
                        </div>
                      </div>';

            })
            ->addColumn('report',function ($item){
                return 'dsad';
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
                                            <a class="dropdown-item" onclick="getSupervisorData('.$row->id.')" href="#" data-toggle="modal"
                                                data-target=".create-supervisor">
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
     * @return JsonResponse
     */
    public function store(UserRequest $request)
    {
        $data = $request->only('name','civil_id','mobile','phone','address');
        $address = $request->only('addressName','government','region','widget','street','avenue','home_number','floor', 'flat');



        if ($request->get('supervisor_id') && (int)$request->get('supervisor_id') > 0) {
            $user = User::where('id', $request->get('supervisor_id'))->first();
            if ($request->hasFile('image'))
            {
                $data['image'] = $this->upload($request->file('image'),'supervisors');
                $this->deleteFile('supervisors', $user->image);
            }

            $user->update($data);
            $message = trans('lang.data_updated');
        } else {
            $data['image'] = $request->hasFile('image') ?  $this->upload($request->file('image'),'supervisors') : '';
            $supervisor = Supervisor::create(['created_by'=> auth()->id()]);
            $data['type'] = 2;
            $user = $supervisor->user()->create($data);
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
     * @return JsonResponse
     */
    public function show($id)
    {
        $admin = Supervisor::where('id', $id)->with('user')->first();
        return \response()->json(['data'=>$admin]);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $supervisor = Supervisor::find($id);
        $this->deleteFile('supervisors', $supervisor->user->image);
        $supervisor->user()->delete();
        $supervisor->delete();
        return \response()->json(['message'=> trans('lang.deleted_message', ['item' => trans('lang.user')])]);
    }
}
