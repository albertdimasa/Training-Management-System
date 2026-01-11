<?php

namespace App\Enums\Master;

enum VenueType: string
{
    case INHOUSE = 'INHOUSE';
    case CLIENT_SITE = 'CLIENT_SITE';
    case HOTEL = 'HOTEL';
    case ONLINE = 'ONLINE';
}
