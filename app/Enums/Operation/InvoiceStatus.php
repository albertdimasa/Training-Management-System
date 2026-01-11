<?php

namespace App\Enums\Operation;

enum InvoiceStatus: string
{
    case UNPAID = 'UNPAID';
    case PARTIAL = 'PARTIAL';
    case PAID = 'PAID';
    case VOID = 'VOID';
}
