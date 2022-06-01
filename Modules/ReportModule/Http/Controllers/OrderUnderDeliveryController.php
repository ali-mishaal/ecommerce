<?php

namespace Modules\ReportModule\Http\Controllers;

use App\DataTables\OrderUnderDeliveryDataTable;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OrderModule\Entities\OrderStatus;
use Modules\UserModule\Entities\Driver;
use Modules\UserModule\Entities\Supervisor;

class OrderUnderDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(OrderUnderDeliveryDataTable $orderUnderDeliveryDataTable)
    {

        $id = auth()->user()->user_id;
        $driver_id = auth()->user()->hasRole('driver') ?  $id : null;
        $supervisor = auth()->user()->hasRole('supervisor') ? $id : null;

        $drivers = Driver::where('id', '<>', auth()->user()->user_id)->get();
        $supervisors = Supervisor::where('id', '<>', auth()->user()->user_id)->get();

        $statuses = OrderStatus::where('driver_can_edit', true)->get();

        $order_statuses = OrderStatus::all();


        return $orderUnderDeliveryDataTable
            ->with('driver_id', $driver_id)
            ->with('supervisor_id', $supervisor)
            ->with(['from_date' => $request->from_date ?? Carbon::today()])
            ->with(['to_date' => $request->to_date ?? Carbon::tomorrow()])
            ->with(['filter_client_id' => $request->filter_client_id ?? null])
            ->with(['filter_supervisor_id' => $request->filter_supervisor_id ?? null])
            ->with(['filter_driver_id' => $request->filter_driver_id ?? null])
            ->with(['status' => $request->status ?? null])
            ->render('reportmodule::orderUnderDelivery.index', compact('drivers', 'supervisors', 'statuses', 'order_statuses'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('reportmodule::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('reportmodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('reportmodule::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
