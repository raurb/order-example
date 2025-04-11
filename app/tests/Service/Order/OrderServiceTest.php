<?php

declare(strict_types=1);

namespace OrderExample\Tests\Service\Order;

use OrderExample\Data\Order\Dto\UpdateOrderDto;
use OrderExample\Data\Order\Enum\OrderStatus;
use OrderExample\Data\Order\Model\Order;
use OrderExample\Repository\Item\ItemRepositoryInterface;
use OrderExample\Repository\Order\OrderRepositoryInterface;
use OrderExample\Service\Order\OrderService;
use OrderExample\Service\Order\OrderValidator;
use PHPUnit\Framework\TestCase;

class OrderServiceTest extends TestCase
{
    public function setUp(): void
    {
        $this->orderRepositoryMock = $this->createMock(OrderRepositoryInterface::class);
        $this->itemRepositoryMock = $this->createMock(ItemRepositoryInterface::class);
        $this->orderValidatorMock = $this->createMock(OrderValidator::class);
        $this->orderModelMock = $this->createMock(Order::class);
    }

    public function testUpdateOrder(): void
    {
        $service = new OrderService($this->orderRepositoryMock, $this->itemRepositoryMock, $this->orderValidatorMock);
        $dto = new UpdateOrderDto('test-uuid', OrderStatus::PAID);

        $this->orderRepositoryMock
            ->expects($this->once())
            ->method('findByUuid')
            ->with('test-uuid')
            ->willReturn($this->orderModelMock);

        $service->updateOrder($dto);
    }
}