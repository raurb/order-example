<?php

declare(strict_types=1);

namespace OrderExample\Data\Order\Dto;

use OrderExample\Data\Item\Dto\ItemDto;
use OrderExample\Data\Order\Enum\OrderStatus;
use OrderExample\Data\Order\Model\Order;
use Ramsey\Uuid\UuidInterface;

readonly class OrderDto
{
    public function __construct(
        public UuidInterface $uuid,
        /** @param ItemDto[] $items */
        public array $items,
        public \DateTimeInterface $createdAt,
        public float $totalPrice,
        public OrderStatus $status,
    ) {
    }

    public static function fromModel(Order $order): self
    {
        $items = [];

        foreach ($order->getItems() as $item) {
            $items[] = new ItemDto(
                id: $item->getItemId(),
                name: $item->getName(),
                quantity: $item->getQuantity(),
                unitPrice: $item->getUnitPrice(),
            );
        }

        return new self(
            uuid: $order->getUuid(),
            items: $items,
            createdAt: $order->getCreatedAt(),
            totalPrice: $order->getTotalPrice(),
            status: $order->getStatus(),
        );
    }
}