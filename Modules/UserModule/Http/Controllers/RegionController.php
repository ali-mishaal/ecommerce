<?php

namespace Modules\UserModule\Http\Controllers;

use App\DataTables\RegionDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\UserModule\Entities\Government;
use Modules\UserModule\Entities\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(RegionDataTable $regionDataTable)
    {
        $governments = Government::all();
        return $regionDataTable->render('usermodule::region', compact('governments'));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => ['required', 'string'],
            'name_en' => ['required', 'string'],
            'goverment_id' => ['required', Rule::exists('governments', 'id')],
        ]);

        Region::create($request->all());
        session()->flash('message', trans('lang.created_message', ['item' => trans('lang.region')]));
        return redirect()->route('regions.index');
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name_ar' => ['required', 'string'],
            'name_en' => ['required', 'string'],
            'goverment_id' => ['required', Rule::exists('governments', 'id')],
        ]);
        $region->update($request->all('name_ar', 'name_en', 'goverment_id'));
        session()->flash('message', trans('lang.updated_message', ['item' => trans('lang.region')]));
        return redirect()->route('regions.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Region $region)
    {
        $region->delete();
        session()->flash('message', trans('lang.deleted_message', ['item' => trans('lang.region')]));
        return redirect()->route('regions.index');
    }
}
