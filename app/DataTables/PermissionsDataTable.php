<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PermissionsDataTable extends DataTable
{

    protected $roles;


    public function __construct()
    {
        $this->roles = Role::all();
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        $columns = array_column($this->getColumns(), 'data');
        $dataTables =  datatables()
            ->eloquent($query);
//        ->addColumn('class', function ($model) {
//            return explode('.', $model->name)[0];
//        });

        foreach ($this->roles as $role)
        {
            $dataTables = $dataTables->addColumn($role->name, function ($model) use ($role) {
                $checked = $role->hasPermissionTo($model) ? 'checked' : '';
               return '<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="'. $model->id  .'-'. $role->name . '" onchange="assignPermissionToRole(\' ' . route('permission.assign', [$role->id, $model->id]) . '\')" ' . $checked .  '>
                        <label class="custom-control-label" for="' . $model->id .'-'. $role->name .'"></label>
                    </div>';
            });
        };

            $dataTables->addColumn('settings', function ($model) {
                return '<button class="btn btn-sm btn-primary" onclick="editPermission(\''. route('permissions.update', $model->id).'\', \' '. $model->name.'\')"><i class="fa fa-edit"></i></button>
            <button class="btn btn-sm btn-danger m-1" onclick="deletePermission(\''. route('permissions.destroy', $model->id).'\')"><i class="fa fa-trash"></i></button>';
            });
        return $dataTables->rawColumns(array_merge($columns, ['action','settings']));

    }

    /**
     * Get query source of dataTable.
     *
     * @param Permission $model
     * @return Builder
     */
    public function query(Permission $model)
    {
        return $model->newQuery()->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('permissions-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->parameters([
                        'lengthChange' => true,
//                        'rowGroup'=>[
//                            'dataSrc' => 'class'
//                        ],
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

        $columns = [
            Column::computed('id', '#'),
//            Column::make('class')->searchable(false)->className('hide')->visible(false),
            Column::computed('name', trans('lang.name'))->searchable(true),
        ];

        foreach($this->roles as $role)
        {
            array_push($columns, Column::make($role->name)->orderable(false)->searchable(false));
        }

        array_push($columns, Column::make('settings')->title(trans('lang.settings'))->orderable(false)->searchable(false));

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Permissions_' . date('YmdHis');
    }
}
