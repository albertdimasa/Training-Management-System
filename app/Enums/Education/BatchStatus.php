<?php

namespace App\Enums\Education;

enum BatchStatus: string
{
    case PLANNED = 'PLANNED';
    case OPEN = 'OPEN';
    case ONGOING = 'ONGOING';
    case COMPLETED = 'COMPLETED';
    case CANCELLED = 'CANCELLED';
}
