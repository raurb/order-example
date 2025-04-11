<?php

declare(strict_types=1);

namespace OrderExample\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use OrderExample\Entity\Item\ItemsEntity;

#[ORM\Entity]
#[ORM\Table(name: "order_items")]
class OrderItemsEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'float')]
    private float $unitPrice;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\ManyToOne(targetEntity: OrdersEntity::class, inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private OrdersEntity $order;

    #[ORM\ManyToOne(targetEntity: ItemsEntity::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ItemsEntity $item;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): self
    {
        $this->unitPrice = $unitPrice;
        return $this;
    }

    public function getOrder(): OrdersEntity
    {
        return $this->order;
    }

    public function setOrder(OrdersEntity $order): self
    {
        $this->order = $order;
        return $this;
    }

    public function getItem(): ItemsEntity
    {
        return $this->item;
    }

    public function setItem(ItemsEntity $item): self
    {
        $this->item = $item;
        return $this;
    }
}