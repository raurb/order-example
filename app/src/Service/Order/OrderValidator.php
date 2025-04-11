<?php

declare(strict_types=1);

namespace OrderExample\Service\Order;

use OrderExample\Data\Order\Model\Order;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderValidator
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    public function validate(Order $order): ConstraintViolationListInterface
    {
        return $this->validator->validate($order);
    }
}