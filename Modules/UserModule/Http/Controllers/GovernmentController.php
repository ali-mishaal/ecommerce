<?php

namespace Modules\UserModule\Http\Controllers;

use App\DataTables\GovernmentsDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserModule\Entities\Government;

class GovernmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param GovernmentsDataTable $governmentsDataTable
     * @return mixed
     */
    public function index(GovernmentsDataTable $governmentsDataTable)
    {
        return $governmentsDataTable->render('usermodule::government');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        Government::create($request->all());
        session()->flash('message', trans('lang.created_message', ['item' => trans('lang.government')]));
        return redirect()->route('governments.index');
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Government $gov
     * @return RedirectResponse
     */
    public function update(Request $request,Government $government): RedirectResponse
    {
        $government->update($request->all('name_ar', 'name_en'));
        session()->flash('message', trans('lang.updated_message', ['item' => trans('lang.government')]));
        return redirect()->route('governments.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Government $government): RedirectResponse
    {
        $government->delete();
        session()->flash('message', trans('lang.deleted_message', ['item' => trans('lang.government')]));
        return redirect()->route('governments.index');
    }
}
