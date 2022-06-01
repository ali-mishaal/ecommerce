<?php

namespace App\DataTables;

use Modules\UserModule\Entities\Supervisor;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SuperVisorsDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->make(true);
    }

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('report',function ($item){
                return 'aly';
            })
            ->addColumn('action', 'supervisorsdatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SuperVisorsDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $supervisors = Supervisor::query()->leftJoin('users', 'supervisors.id', '=', 'users.user_id')
            ->where('users.user_type', Supervisor::class)
            ->select('supervisors.*', 'civil_id','mobile','name','address');
        return $this->applyScopes($supervisors);

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns([
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
            ])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::computed('report'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SuperVisors_' . date('YmdHis');
    }
}
