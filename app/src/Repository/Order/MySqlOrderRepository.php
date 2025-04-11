<?php

declare(strict_types=1);

namespace OrderExample\Repository\Order;

use Doctrine\ORM\EntityManagerInterface;
use OrderExample\Data\Order\Factory\OrderFactory;
use OrderExample\Data\Order\Model\Order;
use OrderExample\Entity\Item\ItemsEntity;
use OrderExample\Entity\Order\OrdersEntity;
use OrderExample\Entity\Order\OrderItemsEntity;

class MySqlOrderRepository implements OrderRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function findByUuid(string $uuid): ?Order
    {
        $repository = $this->entityManager->getRepository(OrdersEntity::class);
        $entity = $repository->findOneByUuid($uuid);

        if (!$entity) {
            return null;
        }

        return OrderFactory::fromEntity($entity);
    }

    public function persist(Order $order): void
    {
        if (!$order->getId()) {
            $this->createOrder($order);
            return;
        }

        $orderEntity = $this->entityManager->find(OrdersEntity::class, $order->getId());

        if (!$orderEntity) {
            throw new \RuntimeException('Order not found');
        }

        $this->updateOrder($orderEntity, $order);
    }

    private function createOrder(Order $order): void
    {
        $orderEntity = new OrdersEntity($order->getStatus());
        $orderEntity
            ->setUuid($order->getUuid())
            ->setCreatedAt($order->getCreatedAt())
            ->setTotalPrice($order->getTotalPrice());

        foreach ($order->getItems() as $item) {
            $orderItemEntity = new OrderItemsEntity();
            $orderItemEntity
                ->setOrder($orderEntity)
                ->setName($item->getName())
                ->setItem($this->entityManager->getReference(ItemsEntity::class, $item->getItemId()))
                ->setQuantity($item->getQuantity())
                ->setUnitPrice($item->getUnitPrice());

            $orderEntity->addItem($orderItemEntity);
        }

        $this->entityManager->persist($orderEntity);
        $this->entityManager->flush();
    }

    private function updateOrder(OrdersEntity $orderEntity, Order $order): void
    {
        $orderEntity->setStatus($order->getStatus());
        $this->entityManager->persist($orderEntity);
        $this->entityManager->flush();
    }
}