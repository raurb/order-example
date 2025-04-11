<?php

declare(strict_types=1);

namespace OrderExample\Data\Order\Model;

use Symfony\Component\Validator\Constraints as Assert;

readonly class OrderItem
{
    private float $totalPrice;

    public function __construct(
        #[Assert\NotBlank]
        private string $name,
        #[Assert\Positive]
        private int $quantity,
        #[Assert\PositiveOrZero]
        private float $unitPrice,
        private ?int $orderId = null,
        private ?int $orderItemId = null,
        private ?int $itemId = null,
    ) {
        $this->totalPrice = $this->unitPrice * $this->quantity;
    }

    public function getOrderItemId(): int
    {
        return $this->orderItemId;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }
}