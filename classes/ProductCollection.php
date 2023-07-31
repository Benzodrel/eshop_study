<?php


class ProductCollection
{

    private $list;

    public function __construct(array $products)
    {
        $this->list = $products;
    }

    public function getList(): array
    {
        return $this->list;
    }
}