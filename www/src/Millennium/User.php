<?php
namespace Millennium;

class User {
    private int $userId;
    protected string $userName;
    protected array $orderProducts = [];

    public function __construct(int $userId, string $userName)
    {
        $this->userId = $userId;
        $this->userName = $userName;
    }

    public function addProductInOrder($product) {
        $this->orderProducts[] = $product;
    }

    public function getId(): int
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->userName;
    }

    public function getOrder(): array
    {
        return $this->orderProducts;
    }
}