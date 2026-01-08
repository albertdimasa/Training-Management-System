<?php
namespace App\Enums;

enum RegistrationStatus: string
{
    case PENDING = 'pending';
    case BOOKED = 'booked';
    case PAID = 'paid';
    case CANCELLED = 'cancelled';
    
    // Tips Pro: Tambahkan method untuk label agar mudah dipanggil di Frontend
    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Pending',
            self::BOOKED => 'Booked',
            self::PAID => 'Paid',
            self::CANCELLED => 'Cancelled',
        };
    }
}