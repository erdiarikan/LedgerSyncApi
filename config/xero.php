<?php

return [
    'client_id' => env('XERO_CLIENT_ID'),
    'client_secret' => env('XERO_CLIENT_SECRET'),
    'redirect_uri' => env('XERO_REDIRECT_URI'),
    'api_base_url' => env('XERO_API_BASE_URL', 'https://api.xero.com'),
    'identity_url' => env('XERO_IDENTITY_URL', 'https://identity.xero.com'),
    'token_endpoint' => env('XERO_TOKEN_ENDPOINT', '/connect/token'),
    'refresh_token_expires_in_days' => (int) env('XERO_REFRESH_TOKEN_EXPIRES_IN_DAYS', 60),
];
