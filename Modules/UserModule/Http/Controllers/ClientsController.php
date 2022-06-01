<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\UserModule\Entities\Client;
use Modules\UserModule\Entities\Government;
use Modules\UserModule\Entities\User;
use Modules\UserModule\Entities\UserAddress;
use Modules\UserModule\Http\Requests\ClientRequest;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Modules\CommonModule\Entities\PaymentMethod;
use Modules\CommonModule\Entities\PaymentType;

class ClientsController extends Controller
{
    use UploaderHelper;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

         $paymentMethod = PaymentMethod::get();
         $paymentType = PaymentType::get();
         $roles = Role::all();
        $goverments = Government::all();
        return view('usermodule::client',compact('roles','paymentMethod','paymentType','goverments'));
    }

    public function datatables()
    {
        $supervisors = Client::query()->leftJoin('users', 'clients.id', '=', 'users.user_id')
            ->where('users.user_type', Client::class)
            ->select('clients.*', 'civil_id','mobile','name','address');
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
                                        <a class="dropdown-item"  href="'.url("user_addresses/".$row->user->id).'">
                                                <i class="mdi mdi-square-edit-outline mr-1"></i>' . trans('lang.address') .'</a>
                                            <a class="dropdown-item" onclick="getClientData('.$row->id.')" href="#" data-toggle="modal"
                                                data-target=".create-client">
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
    public function store(ClientRequest $request)
    {

        $data = $request->only('name','civil_id','mobile','phone','address');
        $address = $request->only('addressName','government','region','widget','street','avenue','home_number','floor', 'flat');
        $clientData = $request->only('activity','project_data','payment_type_id','limit','payment_method_id','fees','bank_account');



        if ($request->get('client_id') && (int)$request->get('client_id') > 0) {
            $user = User::where('id', $request->get('client_id'))->first();
            if ($request->hasFile('image'))
            {
                $data['image'] = $this->upload($request->file('image'),'clients');
                $this->deleteFile('clients', $user->image);
            }
            $user->update($data);
            Client::where('id',$user->user_id)->update($clientData);
            $message = trans('lang.data_updated');
        } else {
            $data['image'] = $request->hasFile('image') ?  $this->upload($request->file('image'),'clients') : '';
            $client = Client::create($clientData);
            $data['type'] = 4;
            $user = $client->user()->create($data);
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
        $admin = Client::find($id);
        return \response()->json(['data'=>$admin]);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $this->deleteFile('clients', $client->user->image);
        $client->user()->delete();
        $client->delete();
        return \response()->json(['message'=> trans('lang.deleted_message', ['item' => trans('lang.user')])]);
    }
}
