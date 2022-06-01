<?php

namespace Modules\OrderModule\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\Exceptions\CannotCreateClientException;
use App\Http\Requests\CreateOrderReqeust;
use App\Http\Requests\CreateQOrderRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\DriverResource;
use App\Http\Resources\SupervisorResource;
use App\services\OrderService;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Entities\PaymentMethod;
use Modules\CommonModule\Entities\PaymentType;
use Modules\OrderModule\Entities\Customer;
use Modules\OrderModule\Entities\Order;
use Modules\OrderModule\Entities\OrderStatus;
use Modules\OrderModule\Http\Requests\assignMultipeDriversRequest;
use Modules\UserModule\Entities\Client;
use Modules\UserModule\Entities\Driver;
use Modules\UserModule\Entities\Supervisor;
use Modules\UserModule\Entities\Government;
use Modules\UserModule\Entities\User;
use Modules\UserModule\Entities\UserAddress;

class OrderController extends Controller
{


    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(OrderDataTable $orderDataTable, Request $request)
    {

        $id = auth()->user()->user_id;
        $driver_id = auth()->user()->hasRole('driver') ?  $id : null;
        $supervisor = auth()->user()->hasRole('supervisor') ? $id : null;

        $drivers = Driver::where('id', '<>', auth()->user()->user_id)->get();
        $supervisors = Supervisor::where('id', '<>', auth()->user()->user_id)->get();

        $statuses = OrderStatus::where('driver_can_edit', true)->get();

        $order_statuses = OrderStatus::all();


        return $orderDataTable
            ->with('driver_id', $driver_id)
            ->with('supervisor_id', $supervisor)
            ->with(['from_date' => $request->from_date ?? Carbon::today()])
            ->with(['to_date' => $request->to_date ?? Carbon::tomorrow()])
            ->with(['filter_client_id' => $request->filter_client_id ?? null])
            ->with(['filter_supervisor_id' => $request->filter_supervisor_id ?? null])
            ->with(['filter_driver_id' => $request->filter_driver_id ?? null])
            ->with(['status' => $request->status ?? null])
            ->render('ordermodule::index', compact('drivers', 'supervisors', 'statuses', 'order_statuses'));
    }


    public function getClientData($id): JsonResponse
    {

        $address = UserAddress::where('user_id',$id)->get(['name', 'id']);
        return response()->json($address, 200);
    }

    public function getClientAddress($id): JsonResponse
    {
        $data = UserAddress::where('id',$id)->first();
        $data = array_merge($data->toArray(), [
            'phone' => $data->user->phone ?? '',
            'mobile' => $data->user->mobile ?? ''
        ]);
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $drivers = Driver::with('user')->get();
        $goverments = Government::all();
        return view('ordermodule::create', compact('drivers','goverments'));
    }

    public function createQ()
    {
        $drivers = Driver::with('user')->get();
        $clients = Client::with('user')->get();
        $goverments = Government::all();
        return view('ordermodule::CreateQ', compact('drivers','clients','goverments'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateOrderReqeust $request
     * @return RedirectResponse
     */
    public function store(CreateOrderReqeust $request)
    {
        if($request->has('create_new_customer'))
        {
            $this->orderService->createCustomer($request);
        }


        $object = array_merge($request->all(),
            [
                'company_fees' => $request->order_fees,
                'status_id' => 1
            ]);
        Order::create($object);
        $request->session()->flash('message', trans('lang.created_message', ['item' => trans('lang.order')]));
        return redirect()->route('orders.create');
    }


    public function storeQ(CreateQOrderRequest $request): RedirectResponse
    {
        if($request->has('create_new_customer'))
        {
            $this->orderService->createCustomer($request);
        }

        try {
            $client_id = $this->orderService->createNewClient($request->client_name, $request->mobile);
        }catch (CannotCreateClientException $e)
        {
            $request->session()->flash('message', $e->getMessage());
            return  redirect()->back();
        }

        Order::create(array_merge($request->all(),['client_id' => $client_id]));
        $request->session()->flash('message', trans('lang.created_message', ['item' => trans('lang.order')]));
        return redirect()->route('orders.createQ');
    }



    public function edit(Order $order)
    {
        $clients = Client::with('user')->get();
        $drivers = Driver::with('user')->get();
        $governments = Government::all();
        $regions = $order->governmentRel->regions;
        $cregions = $order->cgovernmentRel->regions;
        return view('ordermodule::edit', compact('clients', 'drivers', 'governments', 'order', 'regions', 'cregions'));
    }

    public function update(CreateOrderReqeust $request, Order $order)
    {
        $order->update($request->all());
        $request->session()->flash('message', trans('lang.updated_message', ['item' => trans('lang.order')]));
        return redirect()->route('orders.index');

    }



    public function changeDriver(Request $request, Order $order): JsonResponse
    {
        if(!auth()->user()->hasRole('driver'))
        {
            $this->orderService->supervisorChangeDriver($order, $request->new_driver_id);

            return response()->json(['message' => trans('lang.order_driver_changed')], 200);
        }


        if(($order->driver_id != auth()->user()->user_id) && auth()->user()->hasRole('driver'))
        {
            return response()->json(['message' => trans('lang.you_are_not_the_driver')], 422);
        }


        $order->new_driver_id = $request->new_driver_id;
        $order->save();

        return response()->json(['message' => trans('lang.order_transferred_msg')], 200);

    }

    public function driverApprove(Order $order): JsonResponse
    {
        $ids = array_merge(
            [$order->driver_id, $order->new_driver_id],
            $order->drivers->pluck('id')->toArray(),
        );

        if(!in_array(auth()->user()->user_id, array_unique($ids)))
        {
            return response()->json(['message' =>trans('lang.you_are_not_the_driver')], 422);

        }

        $driver = Driver::find(auth()->user()->user_id);
        $this->orderService->driverApproveOrder($order, $driver->id);



        if($driver->has_commission)
        {
            $this->orderService->calculateOrderFees($order, $driver);
        }

        $order->drivers()->detach();

        return response()->json(['message' => trans('lang.order_approved')], 200);
    }


    public function newDriverRefuse(Order $order): JsonResponse
    {
        if($order->new_driver_id != auth()->user()->user_id)
        {
            return response()->json(['message' => trans('lang.you_are_not_the_driver')], 422);
        }

        $order->new_driver_id = null;
        $order->save();

        return response()->json(['message' => trans('lang.order_refused')], 200);

    }


    public function assignMultipleDrivers(assignMultipeDriversRequest $request, Order $order): JsonResponse
    {
        $order->update([
            'driver_id' => null,
            'new_driver_id' => null,
        ]);
        $order->drivers()->sync($request->drivers);

        return response()->json(['message' => trans('lang.order_assigned_to_many')], 200);

    }


    public function editFeesCalculation(Request $request, Order $order): JsonResponse
    {

        $driver_fees = $request->driver_fees ?? 0;
        $order->update([
            'driver_fees' => $driver_fees,
            'company_fees' => $order->order_fees - $driver_fees,
        ]);
        return response()->json(['message' => trans('lang.updated_message', ['item' => trans('lang.order')])], 200);
    }


    public function SendToAnotherSupervisor(Request $request, Order $order): JsonResponse
    {
        if(!auth()->user()->hasRole('supervisor'))
        {
            return response()->json(['message' => trans('lang.you_are_not_supervisor')], 422);
        }


        $order->update([
            'new_supervisor_id' => $request->new_supervisor_id
        ]);

        return response()->json(['message' => trans('lang.waiting_supervisor_approve')], 200);
    }

    public function supervisorApprove(Order $order)
    {
        $id = auth()->user()->user_id;
        if(!auth()->user()->hasRole('supervisor') || $order->new_supervisor_id != $id)
        {
            return response()->json(['message' => trans('lang.you_are_not_supervisor')], 422);
        }

        $order->update([
            'supervisor_id' => $id,
            'new_supervisor_id' => null
        ]);

        return response()->json(['message' => trans('lang.order_approved')], 200);

    }


    public function supervisorRefuse(Order $order)
    {
        $id = auth()->user()->user_id;

        if(!auth()->user()->hasRole('supervisor') || $order->new_supervisor_id != $id)
        {
            return response()->json(['message' => trans('lang.you_are_not_supervisor')], 422);
        }

        $order->update([
            'new_supervisor_id' => null
        ]);

        return response()->json(['message' => trans('lang.order_refused')], 200);

    }

    public function changeStatus(Request $request, Order $order)
    {

        $order->update([
            'status_id' => $request->status_id
        ]);

        return redirect()->route('orders.index');
    }


    public function getClientsSelect2(Request $request)
    {

        $query = Client::with('user');
        if ($request->has('searchTerm') && $request->searchTerm != '')
        {
            $paginate = $this->orderService->select2Paginate($query->count(), $request->page);
        }
       $query = $this->orderService->getSelect2Query($query, $request->searchTerm, $request->page);


        $clients = $query->get();


        return response()->json([
            'data' => ClientResource::collection($clients),
            'pagination' => $paginate ?? false
        ]);
    }

    public function getCustomersSelect2(Request $request)
    {

        $query = Customer::query();
        if ($request->has('searchTerm') && $request->searchTerm != '')
        {
            $paginate = $this->orderService->select2Paginate($query->count(), $request->page);
        }
        $query = $this->orderService->getSelect2Query($query, $request->searchTerm, $request->page, false);
        $customers = $query->get();


        return response()->json([
            'data' => CustomerResource::collection($customers),
            'pagination' => $paginate ?? false
        ]);
    }


    public function getSupervisorsSelect2(Request $request)
    {
        $query = Supervisor::with('user');

        if ($request->has('searchTerm') && $request->searchTerm != '')
        {
            $paginate = $this->orderService->select2Paginate($query->count(), $request->page);
        }
        $query = $this->orderService->getSelect2Query($query, $request->searchTerm, $request->page);


        $supervisors = $query->get();


        return response()->json([
            'data' => SupervisorResource::collection($supervisors),
            'pagination' => $paginate ?? false
        ]);
    }


    public function getDriversSelect2(Request $request)
    {
        $query = Driver::with('user');

        if ($request->has('searchTerm') && $request->searchTerm != '')
        {
            $paginate = $this->orderService->select2Paginate($query->count(), $request->page);
        }
        $query = $this->orderService->getSelect2Query($query, $request->searchTerm, $request->page);


        $drivers = $query->get();


        return response()->json([
            'data' => DriverResource::collection($drivers),
            'pagination' => $paginate ?? false
        ]);
    }




}
