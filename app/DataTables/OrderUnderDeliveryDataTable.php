<?php

namespace App\DataTables;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Modules\OrderModule\Entities\Order;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrderUnderDeliveryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
//        $columns = array_column($this->getColumns(), 'data');
        return datatables()
            ->eloquent($query)
            ->editColumn('delivery_time', function ($model) {
                return Carbon::parse($model->delivery_time)->toDateTime();
            })->editColumn('created_at', function ($model) {
                return $model->created_at->format('Y-m-d');
            })->editColumn('time', function ($model) {
                return $model->created_at->format('H:i:s');
            })->editColumn('region', function ($model) {
                return \App::getLocale()=='ar'?$model->regionn->name_ar:$model->regionn->name_en;
            })->editColumn('cregionn', function ($model) {
                return \App::getLocale()=='ar'?$model->cregionn->name_ar:$model->cregionn->name_en;
            })
            ->addColumn('supervisor',function($item){
                if($item->supervisor_id)
                    return $item->supervisor->user->username??'';
                return '';
            })->addColumn('client',function($item){
                if($item->client_id)
                    return $item->client->user->username??'';
                return '';
            })->addColumn('driver',function($item){
                if($item->driver_id)
                    return $item->driver->user->username??'';
                return '';
            })->rawColumns(['action','settings']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Order $model
     * @return Builder
     */
    public function query(Order $model)
    {
        return $model->with(['supervisor.user','client.user','driver.user','status'])->whereNotIn('status_id',[7,5])->newQuery();


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


        return $query->with('region')->orderBy('created_at', 'desc');
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
                'responsive'=>true,
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
        $columns= [
            ['data' => 'id', 'title' => __('lang.orderNumber')],
            ['data' => 'client', 'title' => __('lang.client')],
            ['data' => 'region', 'title' => __('lang.fromZone')],
            ['data' => 'cregion', 'title' => __('lang.toZone')],
            ['data' => 'created_at', 'title' => trans('lang.date'),],
            ['data' => 'time', 'title' => trans('lang.time'),],
            ['data' => 'delivery_time', 'title' => trans('lang.Expectedreceiptorder'),],
            ['data' => 'delivery_time', 'title' => trans('lang.Expecteddeliverytime'),],
            [
                'data' => 'amount',
                'title' => trans('lang.totalOrder')
            ],
            [
                'data' => 'amount_taken_by',
                'title' => trans('lang.orderCollection'),
            ],
            [
                'data' => 'order_fees',
                'title' => trans('lang.priceDelivery'),
            ],
            [
                'data' => 'order_fees_taken_by',
                'title' => trans('lang.DeliveryCollection'),
            ],[
                'data' => 'driver_fees',
                'title' => trans('lang.DriverCommission'),
            ],
            ['data' => 'status.name_'.App::getLocale(), 'title' => trans('lang.orderStatus')],
            ['data' => 'customer_name', 'title' => trans('lang.customer')]

        ];
        if(auth()->user()->user_type==NULL)
        {
            $columnsAdd = [['data' => 'supervisor', 'title' => __('lang.supervisor')]];
            array_splice( $columns, 1, 0, $columnsAdd );
        }

        if(!auth()->user()->hasRole('driver'))
        {
            $columnsAdd = [ ['data' => 'driver', 'title' => trans('lang.driver')]];
            array_splice( $columns, 15, 0, $columnsAdd );
        }

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Order_Under_delivery' . date('YmdHis');
    }
}
