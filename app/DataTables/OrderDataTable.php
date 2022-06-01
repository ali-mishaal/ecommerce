<?php

namespace App\DataTables;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Modules\OrderModule\Entities\Order;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        $columns = array_column($this->getColumns(), 'data');
        return datatables()
            ->eloquent($query)
            ->addColumn('client', function ($model) {

                return $model->client->user->name ?? 'removed';
            })
            ->addColumn('driver', function ($model) {
                return $model->driver->user->name ?? 'not Specified';
            })
            ->addColumn('settings', 'ordermodule::datatables.dropdown')
            ->editColumn('driver_approved', function ($model) {
                if($model->driver_id == null && $this->supervisor_id)
                {
                    return '<button class="btn btn-sm btn-primary" onclick="changeDriver('. $model->id .')" data-toggle="modal" data-target="#changeDriverModal">
                             ' . trans("lang.assign_to_driver") . '
                    </button>';
                }
                if($this->driver_id && ($this->driver_id == $model->driver_id || $model->drivers()->where('id',$this->driver_id)->first() ) && !$model->driver_approved)
                {
                    return '<button class="btn btn-sm btn-primary" onclick="driverApproveOrder('. $model->id .')">' . trans("lang.approve") .'</button>
                           <button class="btn btn-sm btn-secondary" onclick="changeDriver('. $model->id .')">'. trans("lang.change") . '</button>';
                }

                if($this->driver_id && $this->driver_id == $model->new_driver_id && !$model->driver_approved)
                {
                    return '<button class="btn btn-sm btn-primary" onclick="driverApproveOrder('. $model->id .')">' . trans("lang.approve") .'</button>
                           <button class="btn btn-sm btn-danger" onclick="driverRefuseOrder('. $model->id .')">' . trans('lang.refuse') . '</button>';
                }
                return $model->driver_approved ? trans('lang.approved') : trans('lang.waiting');
            })
            ->editColumn('is_urgent', function ($model) {
                return $model->is_urgent ? trans('lang.urgent') : trans('lang.postpone');
            })
            ->editColumn('delivery_time', function ($model) {
                return Carbon::parse($model->delivery_time)->toDateTime();
            })
            ->addColumn('new_supervisor', function ($model) {
                if($model->new_supervisor_id)
                {
                    if($this->supervisor_id == $model->new_supervisor_id)
                    {
                        return '<button class="btn btn-sm btn-primary" onclick="sendGetRequest(\''. route('order.supervisor_approve', $model->id) .'\')">' . trans("lang.approve") . '</button>
                           <button class="btn btn-sm btn-danger" onclick="sendGetRequest(\''. route('order.supervisor_refuse', $model->id) .'\')">' . trans("lang.refuse") .'</button>';
                    }

                    return $model->new_supervisor->user->name;
                }
                return 'not specified';
            })
            ->addColumn('action', 'order.action')
            ->rawColumns(array_merge($columns, ['action','settings']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param Order $model
     * @return Builder
     */
    public function query(Order $model)
    {
        $query =  $model->newQuery();


        if ($this->from_date) {
            $query = $query->where('delivery_time', '>=', Carbon::parse($this->from_date));
        }

        if ($this->to_date) {
            $query = $query->where('delivery_time', '<=', Carbon::parse($this->to_date));
        }

        if($this->driver_id)
        {

            $driverId = $this->driver_id;
            $query = $query->where(function($q) use ($driverId) {
                $q->where('driver_id', $driverId)
                    ->orWhere('new_driver_id', $driverId)
                    ->orWhereHas('drivers', function ($q) use($driverId) {
                        return $q->where('id', $driverId);
                    });
            });

        }

        if($this->filter_driver_id)
        {
            $query = $query->where('driver_id', $this->filter_driver_id);
        }



        if($this->supervisor_id)
        {
            $query = $query->where(function ($q) {
                $q->where('supervisor_id', $this->supervisor_id)
                ->orWhere('new_supervisor_id', $this->supervisor_id);
            });
        }

        if($this->filter_supervisor_id)
        {
            $query = $query->where(function($q) {
                $q->where('supervisor_id', $this->filter_supervisor_id)
                    ->orWhere('new_supervisor_id', $this->filter_supervisor_id);
            });

        }

        if($this->filter_client_id)
        {
            $query = $query->where('client_id', $this->filter_client_id);
        }

        if ($this->status)
        {
            $query = $query->where('status_id', $this->status);
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
                    ->setTableId('order-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->responsive(true)
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->scrollX(true)
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
                'data' => 'id',
                'title' => '#'
            ],
            [
                'data' => 'client',
                'title' => trans('lang.client'),
            ],
            [
                'data' => 'driver',
                'title' => trans('lang.driver'),
            ],
            [
                'data' => 'driver_approved',
                'title' => trans('lang.driver_status'),
            ],
            [
                'data' => 'new_supervisor',
                'title' => trans('lang.new_supervisor')
            ],
            [
                'data' => 'amount',
                'title' => trans('lang.amount'),
            ],
            [
                'data' => 'delivery_time',
                'title' => trans('lang.delivery_time'),
            ],
            [
                'data' => 'customer_name',
                'title' => trans('lang.customer_name'),
            ],
            [
                'data' => 'settings',
                'title' => trans('lang.settings'),
                'searchable' => false,
                'orderable' => false


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
        return 'Order_' . date('YmdHis');
    }
}
