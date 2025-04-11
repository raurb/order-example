<?php

declare(strict_types=1);

namespace OrderExample\Data\Order\Factory;

use OrderExample\Data\Order\Model\Order;
use OrderExample\Data\Order\Model\OrderItem;
use OrderExample\Entity\Order\OrdersEntity;

class OrderFactory
{
    public static function fromEntity(OrdersEntity $entity): Order
    {
        $items = [];

        foreach ($entity->getItems() as $item) {
            $items[] = new OrderItem(
                name: $item->getName(),
                quantity: $item->getQuantity(),
                unitPrice: $item->getUnitPrice(),
                orderId: $entity->getId(),
                orderItemId: $item->getItem()->getId(),
                itemId: $item->getId(),
            );
        }

        return new Order(
            items: $items,
            totalPrice: $entity->getTotalPrice(),
            id: $entity->getId(),
            uuid: $entity->getUuid(),
            status: $entity->getStatus(),
            createdAt: $entity->getCreatedAt(),
        );
    }
}