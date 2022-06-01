<?php

namespace Modules\TransferModule\Http\Controllers;

use App\DataTables\DriverVehicleDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Helper\UploaderHelper;


class DriverVehicleController extends Controller
{
    use UploaderHelper;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(DriverVehicleDataTable $driverVehicleDataTable)
    {
       $driver_id = null;
       if(auth()->user()->hasRole('driver'))
       {
           $driver_id = auth()->user()->user_id;
       }
        return $driverVehicleDataTable
            ->with('driver_filter_id', $driver_id)
            ->render('transfermodule::driver-vehicle');
    }
}
