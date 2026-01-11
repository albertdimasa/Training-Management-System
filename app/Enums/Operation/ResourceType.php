<?php

namespace App\Enums\Operation;

enum ResourceType: string
{
    case TRANSACTION_BASED = 'TRANSACTION_BASED';
    case ACCRUAL_BASED = 'ACCRUAL_BASED';
}
