<?php

declare(strict_types=1);

namespace OrderExample\Repository\Item;

use Doctrine\ORM\EntityManagerInterface;
use OrderExample\Data\Item\Model\Item;
use OrderExample\Entity\Item\ItemsEntity;

class MySqlItemRepository implements ItemRepositoryInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function findById(int $id): ?Item
    {
        // TODO: Implement findById() method.
    }

    public function findManyByIds(array $ids): array
    {
        return $this->entityManager->getRepository(ItemsEntity::class)->findBy(['id' => $ids]);
    }

    public function persist(Item $order): void
    {
        // TODO: Implement persist() method.
    }
}