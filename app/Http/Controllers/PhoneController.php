<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneRequest;
use App\Http\Resources\PhoneResource;
use App\Models\Phone;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PhoneController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Phone::class);

        return PhoneResource::collection(Phone::all());
    }

    public function store(PhoneRequest $request)
    {
        $this->authorize('create', Phone::class);

        return new PhoneResource(Phone::create($request->validated()));
    }

    public function show(Phone $phone)
    {
        $this->authorize('view', $phone);

        return new PhoneResource($phone);
    }

    public function update(PhoneRequest $request, Phone $phone)
    {
        $this->authorize('update', $phone);

        $phone->update($request->validated());

        return new PhoneResource($phone);
    }

    public function destroy(Phone $phone)
    {
        $this->authorize('delete', $phone);

        $phone->delete();

        return response()->json();
    }
}
