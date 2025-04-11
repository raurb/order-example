<?php

declare(strict_types=1);

namespace OrderExample\Controller;

use Doctrine\ORM\EntityManagerInterface;
use OrderExample\Data\Item\Dto\ItemDto;
use OrderExample\Data\Order\Dto\UpdateOrderDto;
use OrderExample\Data\Order\Enum\OrderStatus;
use OrderExample\Form\Type\CreateOrderType;
use OrderExample\Service\Order\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/orders', name: 'orders_')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(): Response
    {

        return new JsonResponse(['success' => true]);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function createOrder(Request $request, OrderService $orderService): Response
    {
        $data = \json_decode($request->getContent(), true);

        $items = [];
        foreach ($data['items'] as $item) {
            $items[] =  new ItemDto((int)$item['productId'], $item['productName'], $item['quantity'], $item['price']);
        }

        try {
            $orderService->createOrder($items);
        } catch (\Exception $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }

        return new Response('', Response::HTTP_CREATED);
    }

    #[Route('/{uuid}', name: 'update', methods: ['PATCH'])]
    public function updateOrder(string $uuid, Request $request, OrderService $orderService): Response
    {
        $data = \json_decode($request->getContent(), true);
        $updateOrderDto = new UpdateOrderDto($uuid, OrderStatus::tryFrom(\strtoupper($data['status'])));
        try {
            $orderService->updateOrder($updateOrderDto);
        } catch (\Exception $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    #[Route('/{uuid}', name: 'show', methods: ['GET'])]
    public function getByUuid(string $uuid, OrderService $orderService): Response
    {
        $order = $orderService->getViewByUuid($uuid);

        if (!$order) {
            throw new NotFoundHttpException();
        }

        return new JsonResponse($order);
    }

    #[Route('/test', name: 'test', methods: ['GET'])]
    public function test(EntityManagerInterface $entityManager, OrderService $orderService): Response
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Apple Iphone 15',
                'unitPrice' => 5600.99,
                'quantity' => 2,
            ],
            [
                'id' => 2,
                'name' => 'MacBook Pro 16 M3 PRO',
                'unitPrice' => 17000.11,
                'quantity' => 3,
            ],
            [
                'id' => 3,
                'name' => 'Apple iWatch 5',
                'unitPrice' => 3677.24,
                'quantity' => 4,
            ],
        ];

//        foreach ($data as $item) {
//            $entity = new ItemsEntity($item['name'], $item['unitPrice']);
//            $entityManager->persist($entity);
//        }
//        $entityManager->flush();

        $itemDtos = [];

        foreach ($data as $item) {
            $itemDtos[] = new ItemDto($item['id'], $item['name'], $item['quantity'], $item['unitPrice']);
        }
        $orderService->createOrder($itemDtos);
        return new JsonResponse(['success' => true]);
    }
}