<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyUserRoleRequest;
use App\Http\Resources\CompanyUserRoleResource;
use App\Models\CompanyUserRole;

class CompanyUserRoleController extends Controller
{
    public function index()
    {
        return CompanyUserRoleResource::collection(CompanyUserRole::all());
    }

    public function store(CompanyUserRoleRequest $request)
    {
        return new CompanyUserRoleResource(CompanyUserRole::create($request->validated()));
    }

    public function show(CompanyUserRole $companyUserRole)
    {
        return new CompanyUserRoleResource($companyUserRole);
    }

    public function update(CompanyUserRoleRequest $request, CompanyUserRole $companyUserRole)
    {
        $companyUserRole->update($request->validated());

        return new CompanyUserRoleResource($companyUserRole);
    }

    public function destroy(CompanyUserRole $companyUserRole)
    {
        $companyUserRole->delete();

        return response()->json();
    }
}
