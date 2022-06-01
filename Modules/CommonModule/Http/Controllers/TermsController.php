<?php

namespace Modules\CommonModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Entities\TermsAndConditions;

class TermsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function index(): Renderable
    {
        $terms = TermsAndConditions::first();
        return view('commonmodule::terms.index', compact('terms'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $terms = TermsAndConditions::first();
        if($terms)
        {
            $terms->update($request->all());

            return redirect()->route('terms.index');
        }
        TermsAndConditions::create($request->all());

        return redirect()->route('terms.index');

    }


    public function show($type)
    {
        $terms = TermsAndConditions::first()->only($type);

        return view('commonmodule::terms.show', compact('terms'));
        dd($terms);
    }

}
