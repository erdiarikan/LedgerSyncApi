<?php

namespace App\Http\Controllers\Xero;

use App\Http\Controllers\Controller;
use App\Http\Requests\XeroCallbackRequest;
use App\Services\XeroAuthService;

class XeroAuthController extends Controller
{
    private XeroAuthService $xeroAuthService;

    public function __construct(XeroAuthService $xeroAuthService)
    {
        $this->xeroAuthService = $xeroAuthService;
    }

    public function __invoke(XeroCallbackRequest $request)
    {
        $validated = $request->validated();

        try {
            $accessToken = $this->xeroAuthService->exchangeCodeForToken($validated['code']);
            return response()->json([
                'success' => true,
                'access_token' => $accessToken,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
