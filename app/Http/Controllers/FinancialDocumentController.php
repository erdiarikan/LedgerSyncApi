<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinancialDocumentRequest;
use App\Http\Resources\FinancialDocumentResource;
use App\Models\FinancialDocument;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FinancialDocumentController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', FinancialDocument::class);

        return FinancialDocumentResource::collection(FinancialDocument::all());
    }

    public function store(FinancialDocumentRequest $request)
    {
        $this->authorize('create', FinancialDocument::class);

        return new FinancialDocumentResource(FinancialDocument::create($request->validated()));
    }

    public function show(FinancialDocument $financialDocument)
    {
        $this->authorize('view', $financialDocument);

        return new FinancialDocumentResource($financialDocument);
    }

    public function update(FinancialDocumentRequest $request, FinancialDocument $financialDocument)
    {
        $this->authorize('update', $financialDocument);

        $financialDocument->update($request->validated());

        return new FinancialDocumentResource($financialDocument);
    }

    public function destroy(FinancialDocument $financialDocument)
    {
        $this->authorize('delete', $financialDocument);

        $financialDocument->delete();

        return response()->json();
    }
}
