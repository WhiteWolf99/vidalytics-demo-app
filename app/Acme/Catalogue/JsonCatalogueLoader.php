<?php

namespace Acme\Catalogue;

class JsonCatalogueLoader implements CatalogueLoaderInterface
{
    const PRODUCT_LIST_FILE = __DIR__.'/../data/products.json';

    public function loadData()
    {
        if (!file_exists(self::PRODUCT_LIST_FILE)) {
            throw new \Exception(sprintf('Product data file not found %s', self::PRODUCT_LIST_FILE));
        }

        $data = json_decode(file_get_contents(self::PRODUCT_LIST_FILE), true);

        return $data;
    }
}
