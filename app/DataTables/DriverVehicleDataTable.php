<?php

namespace App\DataTables;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Modules\TransferModule\Entities\DriverVehicle;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class DriverVehicleDataTable extends DataTable
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
            ->addColumn('vehicle_number', function ($model) {
                return $model->vehicle->vehicle_number;
            })
            ->addColumn('driver_name', function ($model) {
                return $model->driver->user->name;
            })
            ->editColumn('updated_at', function ($row){
                return Carbon::parse($row->updated_at)->diffForHumans();
            })
            ->rawColumns(array_merge($columns, ['action']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param DriverVehicle $model
     * @return Builder
     */
    public function query(DriverVehicle $model)
    {
        $query =  $model->newQuery();

        if($this->driver_filter_id)
        {
            $query = $query->where('driver_id', $this->driver_filter_id);
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
                    ->setTableId('drivervehicle-table')
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
                'title' => trans('lang.vehicle'),
            ],
            [
                'data' => 'driver_name',
                'title' => trans('lang.driver'),
            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.last_update'),
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'DriverVehicle_' . date('YmdHis');
    }
}
