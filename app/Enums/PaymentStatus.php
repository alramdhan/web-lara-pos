<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case Unpaid = 'unpaid';
    case Pending = 'pending';
    case Paid = 'paid';
    case Failed = 'failed';
    case Canceled = 'canceled';

    public function color(): string
    {
        return match($this) {
            self::Pending => 'warning',
            self::Paid => 'success',
            self::Failed, self::Canceled => 'danger'
        };
    }
}
