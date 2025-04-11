<?php

declare(strict_types=1);

namespace OrderExample\Data\Order\Model;

use OrderExample\Data\Order\Enum\OrderStatus;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

class Order
{
    /**
     * @param OrderItem[] $items
     * @param int|null $id
     * @param UuidInterface|null $uuid
     * @param OrderStatus|null $status
     * @param \DateTimeImmutable|null $createdAt
     */
    public function __construct(
        #[Assert\Count(min: 1)]
        #[Assert\All([new Assert\Type(OrderItem::class)])]
        private array $items,
        private float $totalPrice = 0.0,
        private readonly ?int $id = null,
        private ?UuidInterface $uuid = null,
        private ?OrderStatus $status = OrderStatus::NEW,
        private ?\DateTimeImmutable $createdAt = null,
    ) {
        if (!$this->totalPrice) {
            foreach ($items as $item) {
                $this->totalPrice += $item->getTotalPrice();
            }
        }

        if (!$this->createdAt) {
            $this->createdAt = new \DateTimeImmutable();
        }

        if (!$this->uuid) {
            $this->uuid = Uuid::uuid4();
        }
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function setStatus(OrderStatus $status): void
    {
        $this->status = $status;
    }
}