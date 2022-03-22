<?php

namespace App\Exercise\Shipping;

class User
{
    private int $id;
    private string $name;
    private float $cep;

    public function __construct(int $id, string $name, float $cep)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cep = $cep;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCep(): float
    {
        return $this->cep;
    }
}
