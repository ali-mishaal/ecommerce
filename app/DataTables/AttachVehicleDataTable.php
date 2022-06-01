<?php

namespace App\DataTables;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Modules\TransferModule\Entities\AttachVehicle;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class AttachVehicleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $columns = array_column($this->getColumns(), 'data');
        return datatables()
            ->eloquent($query)
            ->addColumn('vehicle_number', function ($row) {
                return $row->vehicle->vehicle_number;
            })
            ->addColumn('driver_name', function ($row) {
                return $row->driver->user->name;
            })
            ->editColumn('driver_status', function ($row){
                if(auth()->user()->hasRole('driver') && !$row->driver_status)
                {
                    return '<button class="btn btn-success btn-sm" onclick="getAttachVehicleData(' . $row->id .')">Terms & Conditions</button>';
                }
                return $row->driver_status ? 'Approved' : 'Waiting';
            })
            ->editColumn('supervisor_status', function ($row){
                if(auth()->user()->hasAnyRole(['supervisor', 'admin']) && !$row->supervisor_status)
                {
                    return '<button class="btn btn-success btn-sm" onclick="getAttachVehicleData(' . $row->id .')">See Data</button>';
                }
                return $row->supervisor_status ? 'Approved' : 'Waiting';
            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->diffForHumans();
            })->addColumn('action', 'attachvehicle.action')
            ->rawColumns(array_merge($columns, ['action']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param AttachVehicle $model
     * @return Builder
     */
    public function query(AttachVehicle $model)
    {
        $query = $model->newQuery();
        if($this->driver_filter)
        {
            $query = $query->where('driver_id', $this->driver_filter);
        }
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('attachvehicle-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters([
                        'lengthChange' => true,
                        'pageLength' => 30,
                        'language' => json_decode(
                            file_get_contents(base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                            ), true)
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'data' => 'vehicle_number',
                'title' => trans('lang.vehicle')
            ],
            [
                'data' => 'driver_name',
                'title' => trans('lang.driver'),
            ],
            [
                'data' => 'request_km',
                'title' => trans('lang.km_number')
            ],
            [
                'data' => 'driver_status',
                'title' => trans('lang.driver_status')
            ],
            [
                'data' => 'supervisor_status',
                'title' => trans('lang.supervisor_status')
            ],
            [
                'data' => 'request_note',
                'title' => trans('lang.note')
            ],
            [
                'data' => 'created_at',
                'title' => trans('lang.created_at')
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AttachVehicle_' . date('YmdHis');
    }
}
