<?php

declare(strict_types=1);

namespace OrderExample\Repository\Item;

use OrderExample\Data\Item\Model\Item;

interface ItemRepositoryInterface
{
    public function findById(int $id): ?Item;
    public function findManyByIds(array $ids): array;
    public function persist(Item $order): void;
}