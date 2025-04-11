<?php

declare(strict_types=1);

namespace OrderExample\Data\Item\Dto;

readonly class ItemDto
{
    public function __construct(
        public int $id,
        public string $name,
        public int $quantity,
        public float $unitPrice,
    ) {
    }
}