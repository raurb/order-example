<?php

declare(strict_types=1);

namespace OrderExample\Data\Order\Factory;

use OrderExample\Data\Order\Model\OrderItem;

class OrderItemFactory
{
    public static function createNew(string $name, int $quantity, float $unitPrice, int $itemId): OrderItem
    {
        return new OrderItem(
            name: $name,
            quantity: $quantity,
            unitPrice: $unitPrice,
            itemId: $itemId,
        );
    }
}