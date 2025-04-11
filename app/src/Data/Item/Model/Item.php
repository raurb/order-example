<?php

declare(strict_types=1);

namespace OrderExample\Data\Item\Model;

class Item
{
    public function __construct(
        private readonly int $id,
        private string $name,
        private float $price,
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}