<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyPostRequest;
use App\Models\City;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Отображение страницы компаний.
     *
     * @return View
     */
    public function index(): View
    {
        $cities = DB::table('cities')->get();
        $companies = Company::all();
        return view('page.user.companies.index', [
            'cities' => $cities,
            'companies' => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyPostRequest $request
     * @return RedirectResponse
     */
    public function store(CompanyPostRequest $request): RedirectResponse
    {
        Company::create($request->validated());

        return redirect()->route('user.companies.store');
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return View
     */
    public function edit(Company $company): View
    {
        $company = Company::find($company->id);
        $cities = DB::table('cities')->get();
        return view('page.user.companies.edit', [
            'cities' => $cities,
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyPostRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(CompanyPostRequest $request, Company $company): RedirectResponse
    {
        $company = Company::findOrFail($company->id);
        $company->update($request->all());

        return redirect()->route('user.companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company): RedirectResponse
    {
        $company = Company::find($company->id);
        if ($company){
            $company->delete();
        }

        return redirect()->route('user.companies.index');
    }
}
