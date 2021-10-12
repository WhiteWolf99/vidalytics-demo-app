<?php

namespace Acme\Product;

interface ProductInterface 
{
    public function __construct(private string $name, private string $code, private float $price);
    public function getName():string;
    public function setName(string $name);
    public function getCode();
    public function setCode(string $code);
    public function getPrice():float;
    public function setPrice(float $price);
}