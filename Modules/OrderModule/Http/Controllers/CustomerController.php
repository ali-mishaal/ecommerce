<?php

namespace Modules\OrderModule\Http\Controllers;

use App\DataTables\CustomerDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OrderModule\Entities\Customer;
use Modules\UserModule\Entities\Government;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(CustomerDataTable $customerDataTable)
    {
        $governments = Government::all();
        return $customerDataTable->render('ordermodule::customers.index', compact('governments'));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);
        Customer::create($request->all());
        session()->flash('message', trans('lang.created_message', ['item' => trans('lang.customer')]));
        return redirect()->route('customers.index');
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);
        $customer->update($request->all());
        session()->flash('message', trans('lang.updated_message', ['item' => trans('lang.customer')]));
        return redirect()->route('customers.index')->with();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        session()->flash('message', trans('lang.deleted_message', ['item' => trans('lang.customer')]));
        return redirect()->route('customers.index');
    }


    public function getData(Customer $customer)
    {
        return $customer;
    }
}
