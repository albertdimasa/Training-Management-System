<?php

namespace App\Enums\Operation;

enum PaymentMethod: string
{
    case TRANSFER = 'TRANSFER';
    case CASH = 'CASH';
    case VA = 'VA';
    case GIRO = 'GIRO';
    case CARD = 'CARD';
}
