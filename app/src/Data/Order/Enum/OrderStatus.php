<?php

declare(strict_types=1);

namespace OrderExample\Data\Order\Enum;

enum OrderStatus: string
{
    case NEW = 'NEW';
    case PAID = 'PAID';
    case SHIPPED = 'SHIPPED';
    case CANCELED = 'CANCELED';

    public const array AVAILABLE_STATUSES = [
        self::NEW,
        self::PAID,
        self::SHIPPED,
        self::CANCELED,
    ];
}
