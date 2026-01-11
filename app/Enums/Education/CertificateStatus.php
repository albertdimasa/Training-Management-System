<?php

namespace App\Enums\Education;

enum CertificateStatus: string
{
    case ISSUED = 'ISSUED';
    case REVOKED = 'REVOKED';
    case EXPIRED = 'EXPIRED';
}
