<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Company::class);

        return CompanyResource::collection(auth()->user()->companies);
    }

    public function store(CompanyRequest $request)
    {
        $this->authorize('create', Company::class);

        $company = Company::create($request->validated());

        auth()->user()->companies()->attach($company->uuid);

        return new CompanyResource($company);
    }

    public function show(Company $company)
    {
        $this->authorize('view', $company);

        return new CompanyResource($company);
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $this->authorize('update', $company);

        $company->update($request->validated());

        return new CompanyResource($company);
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $company->delete();

        return response()->json();
    }
}
