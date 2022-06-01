<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use phpDocumentor\Reflection\Utils;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $roles = Role::all();
        return view('usermodule::roles.roles',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $permissionGroups = Permission::get()->groupBy('title_en');
        return view('usermodule::roles.create_role',compact('permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'name'=>'required|string',
//            'name_ar'=>'required|string',
//            'permissions'=>'required',
//        ]);

        try {
            $data = $request->only('name','name_ar');
            $data['guard_name'] = 'web';
            $role = Role::create($data);
            $role->syncPermissions($request->get('permissions'));
            return \response()->json(['message'=> trans('lang.created_message', ['item' => trans('lang.role')]),'code'=>200]);
        }catch (\Exception $e){
            return \response()->json(['message'=>$e->getMessage(),'code'=>400])->send();
        }


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('usermodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Role $role)
    {
        $permissionGroups = Permission::get()->groupBy('title_en');
        return view('usermodule::roles.edit_role',compact('role','permissionGroups'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $role = Role::findById($id);
            $data = $request->only('name','name_ar');
            $role->update($data);
            $role->syncPermissions($request->get('permissions'));
            return \response()->json(['message'=> trans('lang.updated_message', ['item' => trans('lang.role')]),'code'=>200]);
        }catch (\Exception $e){
            return \response()->json(['message'=>$e->getMessage(),'code'=>400])->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
