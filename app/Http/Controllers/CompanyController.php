<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ////////////////////
        // First approach //
        ////////////////////
        // $company = new Company();
        // $company->name = request('name');
        // $company->description = request('description');
        // $company->save();

        ////////////////////
        //Second approach //
        ////////////////////
        // Company::create([
        //     'name' => request('name'),
        //     'description' => request('description')
        // ]);

        ///////////////////
        //Third approach //
        ///////////////////
        // Company::create(request(['name', 'description']));
        // return redirect('/companies');

        ////////////////////
        //With validation //
        ////////////////////
        $validatedRequest = request()->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:10']
        ]);
        Company::create($validatedRequest);
        return redirect('/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        ///////////////////
        //First approach //
        ///////////////////
        // $company->name = request('name');
        // $company->description = request('description');
        // $company->save();
        $company->update(request(['name', 'description']));
        return redirect('/companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect("/companies");
    }
}
