<?php

namespace App\DataTables;


use Illuminate\Database\Eloquent\Builder;
use Modules\OrderModule\Entities\Customer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
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
            ->addColumn('government', function ($model) {
                return $model->government->name_en ?? trans('lang.deleted');
            })
            ->addColumn('region', function ($model) {
                return $model->region->name_en ?? trans('lang.deleted');
            })
            ->addColumn('settings', function ($model) {
                return
                    '<button class="btn btn-sm btn-primary" onclick="editCustomer(\''. route('customers.update', $model->id).'\', \' '. route('get.customer_data', $model->id) . '\')"><i class="fa fa-edit"></i></button>
            <button class="btn btn-sm btn-danger m-1" onclick="deleteCustomer(\''. route('customers.destroy', $model->id).'\')"><i class="fa fa-trash"></i></button>';
            })
            ->rawColumns($columns);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Customer $model
     * @return Builder
     */
    public function query(Customer $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('customer-table')
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
            Column::computed('name', trans('lang.name')),
            Column::computed('mobile', trans('lang.mobile')),
            Column::computed('address_name', trans('lang.address_name')),
            Column::make('government')->title(trans('lang.government')),
            Column::make('region')->title(trans('lang.region')),
            Column::computed('widget', trans('lang.widget')),
            Column::computed('street', trans('lang.street')),
            Column::computed('avenue', trans('lang.avenue')),
            Column::computed('home_number', trans('lang.home_number')),
            Column::computed('floor', trans('lang.floor')),
            Column::computed('flat', trans('lang.flat')),
            Column::make('settings')->title(trans('lang.settings'))
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Customer_' . date('YmdHis');
    }
}
