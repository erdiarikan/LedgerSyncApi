<?php

namespace App\Enums;

enum XeroEndpointsEnum: string
{
    case CONNECTIONS = '/connections';
    case CHART_OF_ACCOUNTS = '/accounts';
}
