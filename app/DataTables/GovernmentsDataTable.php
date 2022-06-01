<?php

namespace App\DataTables;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserModule\Entities\Government;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class GovernmentsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract|EloquentDataTable
     */
    public function dataTable($query)
    {
        $columns = array_column($this->getColumns(), 'data');
        return datatables()
            ->eloquent($query)
            ->editColumn('updated_at', function ($row){
                return Carbon::parse($row->updated_at)->diffForHumans();
            })
            ->addColumn('settings', function ($model) {
                return
                    '<button class="btn btn-sm btn-primary" onclick="editGovernment(\''. route('governments.update', $model->id).'\', \' '. $model->name_ar.' \', \' '. $model->name_en .' \')"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger m-1" onclick="deleteGovernment(\''. route('governments.destroy', $model->id).'\')"><i class="fa fa-trash"></i></button>';
            })
            ->rawColumns(array_merge($columns, ['action','settings']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param Government $model
     * @return Builder
     */
    public function query(Government $model): Builder
    {
        return $model->newQuery()->orderBy('updated_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('governments-table')
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
            Column::computed('id', '#'),
            Column::computed('name_ar', trans('lang.arabic_name')),
            Column::computed('name_en', trans('lang.english_name')),
            Column::computed('updated_at', trans('lang.last_update')),
            Column::make('settings')->title(trans('lang.settings')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Governments_' . date('YmdHis');
    }
}
