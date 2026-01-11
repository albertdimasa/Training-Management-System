<?php

namespace App\Enums\Master;

enum ClientType: string
{
    case CORPORATE = 'CORPORATE';
    case GOVERNMENT = 'GOVERNMENT';
    case EDUCATION = 'EDUCATION';
    case INDIVIDUAL_RESELLER = 'INDIVIDUAL_RESELLER';
}
