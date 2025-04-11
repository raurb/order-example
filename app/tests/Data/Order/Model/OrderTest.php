<?php

declare(strict_types=1);

namespace OrderExample\Tests\Data\Order\Model;

use OrderExample\Data\Order\Model\Order;
use OrderExample\Data\Order\Model\OrderItem;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function setUp(): void
    {
       $this->exampleOrderItems = [
           new OrderItem('test', 3, 24),
           new OrderItem('test', 1, 11.23),
           new OrderItem('test', 5, 22.99),
       ];
    }

    public function testTotalPrice(): void
    {
        $order = new Order($this->exampleOrderItems);
        $this->assertEquals(198.18, $order->getTotalPrice());
    }
}
