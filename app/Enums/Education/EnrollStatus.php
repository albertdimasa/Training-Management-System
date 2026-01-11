<?php

namespace App\Enums\Education;

enum EnrollStatus: string
{
    case REGISTERED = 'REGISTERED';
    case CONFIRMED = 'CONFIRMED';
    case ATTENDED = 'ATTENDED';
    case NO_SHOW = 'NO_SHOW';
    case CANCELLED = 'CANCELLED';
}
