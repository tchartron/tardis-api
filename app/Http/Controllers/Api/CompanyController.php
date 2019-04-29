<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Company;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('here');
        $validatedRequest = request()->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:10']
        ]);
        // dd($errors);
        // dd(Company::create($validatedRequest));
        return response()->json(Company::create($validatedRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $companyResource = new CompanyResource($company);
        return response()->json($companyResource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedRequest = request()->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:10']
        ]);
        $company->update($validatedRequest);
        return response()->json($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        return response()->json($company->delete());
    }
}
