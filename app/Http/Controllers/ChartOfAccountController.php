<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChartOfAccountRequest;
use App\Http\Resources\ChartOfAccountResource;
use App\Models\ChartOfAccount;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ChartOfAccountController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', ChartOfAccount::class);

        return ChartOfAccountResource::collection(ChartOfAccount::all());
    }

    public function store(ChartOfAccountRequest $request)
    {
        $this->authorize('create', ChartOfAccount::class);

        return new ChartOfAccountResource(ChartOfAccount::create($request->validated()));
    }

    public function show(ChartOfAccount $chartOfAccount)
    {
        $this->authorize('view', $chartOfAccount);

        return new ChartOfAccountResource($chartOfAccount);
    }

    public function update(ChartOfAccountRequest $request, ChartOfAccount $chartOfAccount)
    {
        $this->authorize('update', $chartOfAccount);

        $chartOfAccount->update($request->validated());

        return new ChartOfAccountResource($chartOfAccount);
    }

    public function destroy(ChartOfAccount $chartOfAccount)
    {
        $this->authorize('delete', $chartOfAccount);

        $chartOfAccount->delete();

        return response()->json();
    }
}
