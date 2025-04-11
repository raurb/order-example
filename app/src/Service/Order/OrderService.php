<?php

declare(strict_types=1);

namespace OrderExample\Service\Order;

use OrderExample\Data\Item\Dto\ItemDto;
use OrderExample\Data\Item\Model\Item;
use OrderExample\Data\Order\Dto\OrderDto;
use OrderExample\Data\Order\Dto\UpdateOrderDto;
use OrderExample\Data\Order\Factory\OrderItemFactory;
use OrderExample\Data\Order\Model\Order;
use OrderExample\Repository\Item\ItemRepositoryInterface;
use OrderExample\Repository\Order\OrderRepositoryInterface;

class OrderService
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private ItemRepositoryInterface $itemRepository,
        private OrderValidator $orderValidator,
    ) {
    }

    /** @param ItemDto[] $items */
    public function createOrder(array $items): void
    {
        $this->checkIfEveryItemExists($items);

        $order = new Order($this->createOrderItems($items));
        $this->validateOrder($order);

        $this->orderRepository->persist($order);
    }

    public function updateOrder(UpdateOrderDto $updateOrderDto): void
    {
        $orderModel = $this->orderRepository->findByUuid($updateOrderDto->uuid);

        if (!$orderModel) {
            throw new \RuntimeException('Order not found');
        }

        $orderModel->setStatus($updateOrderDto->status);
        $this->orderRepository->persist($orderModel);
    }

    public function getViewByUuid(string $uuid): ?OrderDto
    {
        $order = $this->orderRepository->findByUuid($uuid);

        if (!$order) {
            return null;
        }

        return OrderDto::fromModel($order);
    }

    private function checkIfEveryItemExists(array $items): void
    {
        $itemIds = [];
        foreach ($items as $item) {
            $itemIds[] = $item->id;
        }

        $itemEntities = $this->itemRepository->findManyByIds($itemIds);

        if (!$itemEntities) {
            throw new \RuntimeException('Items not found');
        }

        /** @var Item $item */
        foreach ($itemEntities as $item) {
            if (!\in_array($item->getId(), $itemIds, true)) {
                throw new \RuntimeException(\sprintf('Item with id "%s" does not exist.', $item->getId()));
            }
        }
    }

    private function validateOrder(Order $order): void
    {
        $errors = $this->orderValidator->validate($order);

        if (\count($errors) > 0) {
            throw new \InvalidArgumentException((string)$errors);
        }
    }

    /**
     * @param ItemDto[] $items
     * @return array
     */
    private function createOrderItems(array $items): array
    {
        $orderItems = [];
        foreach ($items as $item) {
            $orderItems[] = OrderItemFactory::createNew($item->name, $item->quantity, $item->unitPrice, $item->id);
        }

        return $orderItems;
    }
}