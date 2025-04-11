<?php

declare(strict_types=1);

namespace OrderExample\Repository\Order;

use OrderExample\Data\Order\Model\Order;

interface OrderRepositoryInterface
{
    public function findByUuid(string $uuid): ?Order;
    public function persist(Order $order): void;
}