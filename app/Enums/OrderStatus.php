<?php

namespace App\Enums;

enum OrderStatus: string
{
    case ORDERED = 'ordered';
    case IN_PROCESS = 'in_process';
    case IN_ROUTE = 'in_route';
    case DELIVERED = 'delivered';
}
