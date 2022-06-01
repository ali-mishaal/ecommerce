<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\UserModule\Entities\Government;
use Modules\UserModule\Entities\Region;
use Modules\UserModule\Entities\User;
use Modules\UserModule\Entities\UserAddress;
use Modules\UserModule\Http\Requests\AdressRequest;
use Modules\UserModule\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
class AdminsController extends Controller
{

    use UploaderHelper;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $roles = Role::all();
        $goverments = Government::all();
        return view('usermodule::administrator',compact('roles','goverments'));
    }

    public function datatables()
    {
        $admins = User::query();
        $admins->whereNull('user_id');
        return DataTables::of($admins->where('type',1))
            ->addColumn('operations', function ($row) {
                return '<div class="dropdown-basic">
                                    <div class="dropdown">
                                        <button class="btn dropbtn btn-primary btn-round dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" onclick="getAdminData('.$row->id.')" href="'.url("user_addresses/$row->id").'">
                                                <i class="mdi mdi-square-edit-outline mr-1"></i>' . trans("lang.address") . '</a>

                                                <a class="dropdown-item" onclick="getAdminData('.$row->id.')" href="#" data-toggle="modal"
                                                data-target=".create-administrator">
                                                <i class="mdi mdi-square-edit-outline mr-1"></i>' . trans("lang.edit") . '</a>

                                            <a class="dropdown-item" href="#" data-toggle="modal" onclick="getAccountData('.$row->id.')"
                                                data-target=".user-icon">
                                                <i class="mdi mdi-account-circle-outline mr-1"></i>' . trans("lang.user") . '</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" onclick="setUserId('.$row->id.')" href="#" data-toggle="modal"
                                                data-target=".popup-delete">
                                                <i class="mdi mdi-delete-outline mr-1"></i>' . trans("lang.delete") . '</a>
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        $data = $request->only('name','civil_id','mobile','phone','address');
        $address = $request->only('addressName','government','region','widget','street','avenue','home_number','floor', 'flat');

        if ($request->get('admin_id') && (int)$request->get('admin_id') > 0) {
            $user = User::where('id', $request->get('admin_id'))->firstOrFail();
            if ($request->hasFile('image'))
            {
                $data['image'] = $this->upload($request->file('image'),'admins');
                $this->deleteFile('admins', $user->image);
            }
            $user->update($data);
            $message = trans('lang.data_updated');
        } else {
            $data['image'] = $request->hasFile('image') ?  $this->upload($request->file('image'),'admins') : '';
            $user = User::create($data);
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
        $admin = User::find($id);
        return \response()->json(['data'=>$admin]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $this->deleteFile('admins', $user->image);
        $user->delete();
        return \response()->json(['message'=> trans('lang.deleted_message', ['item' => trans('lang.user')])]);
    }

    public function regions($id): string
    {
        $regions = Region::where('goverment_id',$id)->get();
        $result ='<option disabled selected>' . trans('lang.choose') . '</option>';
        foreach ($regions as $key){
            $result .= '<option value="'.$key->id.'">'.$key->name_en.'</option>';
        }

        return $result;
    }

    public function getreigons($govern,$region)
    {
        $regions = Region::where('goverment_id',$govern)->get();
        $result ='';
        foreach ($regions as $key){
            $select = $region == $key->id?'selected':'';
            $result .= '<option '.$select.' value="'.$key->id.'">'.$key->name_en.'</option>';
        }

        return $result;
    }

    public function userAddress($id)
    {
        $address = UserAddress::where('user_id',$id)->get();
        $goverments = Government::all();
        return view('usermodule::address',compact('address','goverments','id'));
    }

    public function saveAddress(AdressRequest $request)
    {

        $address = $request->only('addressName','user_id','government','region','widget','street','avenue','home_number','floor', 'flat');

            $address['name']=$address['addressName'];
            unset($address['addressName']);
            if($request->id==0){
                UserAddress::create($address);
            }else
            {
                UserAddress::where('id',$request->id)->update($address);
            }
            $message = trans('lang.data_saved');

        return \response()->json(['data'=>'done','message'=>$message,'code'=>200]);
    }

    public function deleteAddress($id)
    {

        UserAddress::destroy($id);
        return \response()->json(['message'=> trans('lang.deleted_message', ['item' => trans('lang.address')])]);
    }
}
