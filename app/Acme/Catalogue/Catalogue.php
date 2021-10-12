<?php

namespace Acme\Catalogue;

use Acme\Product\Product;

class Catalogue
{
    private $products;

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $jsonLoader = new JsonCatalogueLoader();
        $productData = $jsonLoader->loadData();

        foreach ($productData as $data) {
            $this->products[] = new Product($data['name'], $data['code'], (float)$data['price']);
        }
    }

    public function getProductByCode($code): Product
    {
        foreach ($this->products as $product) {
            if ($code == $product->getCode()) {
                return $product;
            }
        }

        throw new \Exception(sprintf('No product was found with code: %s', $code));
    }
}
