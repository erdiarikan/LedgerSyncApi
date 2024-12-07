<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinancialDocumentLineItemRequest;
use App\Http\Resources\FinancialDocumentLineItemResource;
use App\Models\FinancialDocumentLineItem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FinancialDocumentLineItemController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', FinancialDocumentLineItem::class);

        return FinancialDocumentLineItemResource::collection(FinancialDocumentLineItem::all());
    }

    public function store(FinancialDocumentLineItemRequest $request)
    {
        $this->authorize('create', FinancialDocumentLineItem::class);

        return new FinancialDocumentLineItemResource(FinancialDocumentLineItem::create($request->validated()));
    }

    public function show(FinancialDocumentLineItem $financialDocumentLineItem)
    {
        $this->authorize('view', $financialDocumentLineItem);

        return new FinancialDocumentLineItemResource($financialDocumentLineItem);
    }

    public function update(
        FinancialDocumentLineItemRequest $request,
        FinancialDocumentLineItem $financialDocumentLineItem
    ) {
        $this->authorize('update', $financialDocumentLineItem);

        $financialDocumentLineItem->update($request->validated());

        return new FinancialDocumentLineItemResource($financialDocumentLineItem);
    }

    public function destroy(FinancialDocumentLineItem $financialDocumentLineItem)
    {
        $this->authorize('delete', $financialDocumentLineItem);

        $financialDocumentLineItem->delete();

        return response()->json();
    }
}
