<?php

namespace App\DataTables;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserModule\Entities\Region;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RegionDataTable extends DataTable
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
            ->editColumn('updated_at', function ($model) {
                return Carbon::parse($model->updated_at)->diffForHumans();
            })
            ->addColumn('government', function ($model) {
                return $model->government->name_en;
            })
            ->addColumn('settings', function ($model) {
                return
                    '<button class="btn btn-sm btn-primary" onclick="editRegion(\''. route('regions.update', $model->id).'\', \' '. $model->name_ar.' \', \' '. $model->name_en .' \', \'' . $model->goverment_id .'\')"><i class="fa fa-edit"></i></button>
            <button class="btn btn-sm btn-danger m-1" onclick="deleteRegion(\''. route('regions.destroy', $model->id).'\')"><i class="fa fa-trash"></i></button>';
            })
            ->rawColumns($columns);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Region $model
     * @return Builder
     */
    public function query(Region $model)
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
                    ->setTableId('region-table')
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
            Column::make('government')->title(trans('lang.government')),
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
        return 'Region_' . date('YmdHis');
    }
}
