<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Payment::class);

        return PaymentResource::collection(Payment::all());
    }

    public function store(PaymentRequest $request)
    {
        $this->authorize('create', Payment::class);

        return new PaymentResource(Payment::create($request->validated()));
    }

    public function show(Payment $payment)
    {
        $this->authorize('view', $payment);

        return new PaymentResource($payment);
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        $this->authorize('update', $payment);

        $payment->update($request->validated());

        return new PaymentResource($payment);
    }

    public function destroy(Payment $payment)
    {
        $this->authorize('delete', $payment);

        $payment->delete();

        return response()->json();
    }
}
