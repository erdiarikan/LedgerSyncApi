<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Resources\EmailResource;
use App\Models\Email;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmailController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Email::class);

        return EmailResource::collection(Email::all());
    }

    public function store(EmailRequest $request)
    {
        $this->authorize('create', Email::class);

        return new EmailResource(Email::create($request->validated()));
    }

    public function show(Email $email)
    {
        $this->authorize('view', $email);

        return new EmailResource($email);
    }

    public function update(EmailRequest $request, Email $email)
    {
        $this->authorize('update', $email);

        $email->update($request->validated());

        return new EmailResource($email);
    }

    public function destroy(Email $email)
    {
        $this->authorize('delete', $email);

        $email->delete();

        return response()->json();
    }
}
