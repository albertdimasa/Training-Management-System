<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case INSTRUCTOR = 'instructor';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::INSTRUCTOR => 'Instructor',
        };
    }
}
