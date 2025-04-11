<?php

declare(strict_types=1);

namespace OrderExample\Data\Order\Dto;

use OrderExample\Data\Order\Enum\OrderStatus;

readonly class UpdateOrderDto
{
    public function __construct(
        public string $uuid,
        public OrderStatus $status,
    )
    {
    }
}