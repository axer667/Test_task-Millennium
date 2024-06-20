<?php
namespace Millennium;

class ProductFactory
{
    public static function makeProduct(string $title, float $price): Product
    {
        return new Product($title, $price);
    }
}