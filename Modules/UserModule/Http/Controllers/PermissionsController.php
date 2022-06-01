<?php

namespace Modules\UserModule\Http\Controllers;


use App\DataTables\PermissionsDataTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{

    public function index(PermissionsDataTable $permissionsDataTable)
    {

        return $permissionsDataTable->render('usermodule::permissions.index');
    }


    public function store(Request $request)
    {
        if ($request->has('only_one'))
        {
            $request->validate([
                'name' => 'required|string'
            ]);
            Permission::create([
                'name' => $request->name,
                'guard_name' => 'web',
                'title_ar' => $request->name,
                'title_en'  => $request->name,
            ]);
            return \response()->json(['code'=>200,'message'=> trans('lang.created_message', ['item' => trans('lang.permission')])]);

        }
        $data=$request->validate([
            'title_ar'=>'required|string',
            'title_en'=>'required|string',
        ]);
        $data['guard_name'] = 'web';
        $name = str_replace(' ','_',$request->get('title_en'));

        $show = $data;
        $show['name'] = 'show_'.$name;
        $create = $data;
        $create['name'] = 'create_'.$name;
        $update = $data;
        $update['name'] = 'update_'.$name;
        $delete = $data;
        $delete['name'] = 'delete_'.$name;

        Permission::create($show);
        Permission::create($create);
        Permission::create($update);
        Permission::create($delete);
        return \response()->json(['code'=>200,'message'=>trans('lang.created_message', ['item' => trans('lang.permission')])]);


    }


    /**
     * @param Request $request
     * @param Permission $permission
     * @return JsonResponse
     */
    public function update(Request $request,Permission $permission): JsonResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);
        $permission->update([
            'name' => $request->name,
            'guard_name' => 'web',
            'title_ar' => $request->name,
            'title_en'  => $request->name,
        ]);
        return \response()->json(['code'=>200,'message'=>trans('lang.updated_message', ['item' => trans('lang.permission')])]);
    }


    public function destroy(Permission $permission)
    {
        $permission->delete();
        return \response()->json(['code'=>200,'message'=>trans('lang.deleted_message', ['item' => trans('lang.permission')])]);
    }

    /**
     * @param Role $role
     * @param Permission $permission
     */
    public function assign(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission))
        {
            $role->revokePermissionTo($permission);
        }else{
            $role->givePermissionTo($permission);
        }
    }

}
