<?php

namespace Modules\UiModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\CommonModule\Entities\CompanyVehicle;
use Modules\CommonModule\Entities\PaymentMethod;
use Modules\CommonModule\Entities\PaymentType;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\UserModule\Entities\Client;
use Modules\UserModule\Entities\Driver;
use Modules\UserModule\Entities\Supervisor;
use Modules\UserModule\Entities\User;
use Modules\UserModule\Http\Requests\ClientRequest;
use Modules\UserModule\Http\Requests\DriverRequest;
use Modules\UserModule\Http\Requests\UserRequest;

class RegisterController extends Controller
{
    use UploaderHelper;
   public function register($type)
   {
       $paymentMethod = PaymentMethod::get();
       $paymentType = PaymentType::get();
       $vehicles = CompanyVehicle::get();
       return view('uimodule::register.'.$type,compact('paymentMethod','paymentType','vehicles'));
   }


   public function supervisorRegister(UserRequest $request)
   {
       $data = $request->only('name','civil_id','mobile','address','username');
       $data['password'] = Hash::make($request->password);
       if ($request->hasFile('image'))
           $data['image'] = $this->upload($request->file('image'),'supervisors');

           $supervisor = Supervisor::create(['created_by'=>1]);
           $supervisor->user()->create($data);
           $message = trans('lang.data_saved');

       return \response()->json(['data'=>'done','message'=>$message,'code'=>200]);
   }

    public function clientRegister(ClientRequest $request)
    {

        $data = $request->only('name','civil_id','mobile','address','username','password');
        $data['password'] = Hash::make($request->password);
        $clientData = $request->only('activity','project_data','payment_type_id','limit','payment_method_id','fees','bank_account');

        if ($request->hasFile('image'))
            $data['image'] = $this->upload($request->file('image'),'supervisors');

        if ($request->get('client_id') && (int)$request->get('client_id') > 0) {
            $user = User::where('id', $request->get('client_id'))->update($data);
            Client::where('id',$user->user_id)->update($clientData);
            $message = trans('lang.data_updated');
        } else {
            $client = Client::create($clientData);
            $client->user()->create($data);
            $message = trans('lang.data_saved');
        }
        return \response()->json(['data'=>'done','message'=>$message,'code'=>200]);
    }

    public function driverRegister(DriverRequest $request)
    {

        $data = $request->only('name','civil_id','mobile','address','username','password');
        $data['password'] = Hash::make($request->password);
        $driverData = $request->only('has_sallary','sallary','has_commission','commission','has_company_vehicle','company_vehicle_id');

        if ($request->hasFile('image'))
            $data['image'] = $this->upload($request->file('image'),'supervisors');

        if ($request->get('driver_id') && (int)$request->get('driver_id') > 0) {

            $user = User::where('id', $request->get('driver_id'))->update($data);
            Driver::where('id',$user->user_id)->update($driverData);
            $message = trans('lang.data_updated');
        } else {
            $driver = Driver::create($driverData);
            $driver->user()->create($data);
            $message = trans('lang.data_saved');
        }
        return \response()->json(['data'=>'done','message'=>$message,'code'=>200]);
    }
}
