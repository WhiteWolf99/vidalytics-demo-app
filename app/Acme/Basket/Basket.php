<?php

namespace Acme\Basket;

use Acme\Catalogue\Catalogue;
use Acme\DeliveryCostRules\RuleSet as DeliveryCostRuleSet;
use Acme\SpecialOfferRules\RuleSet as SpecialOfferRuleSet;

class Basket
{
    private $lineItems = [];
    private $catalogue;
    private $deliveryCostRuleSet;
    private $specialOfferRuleSet;

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $this->catalogue = new Catalogue();
        $this->deliveryCostRuleSet = new DeliveryCostRuleSet();
        $this->specialOfferRuleSet = new SpecialOfferRuleSet();
    }

    public function add(string $code)
    {
        $product = $this->catalogue->getProductByCode($code);
        $this->lineItems[] = $product;

        return $this;
    }

    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    public function getTotal(): float
    {
        if (!$this->lineItems) {
            throw new \Exception('Busket is empty!');
        }

        $totalProductsCost = 0;
        $deliveryCost = null;
        $specialOfferRules = $this->specialOfferRuleSet->getRules();
        $deliveryCostRules = $this->deliveryCostRuleSet->getRules();

        foreach ($specialOfferRules as $offer) {
            $this->lineItems = $offer->apply($this->lineItems);
        }

        foreach ($this->lineItems as $item) {
            $totalProductsCost += $item->getPrice();
        }

        foreach ($deliveryCostRules as $rule) {
            if (null != $deliveryCost) {
                break;
            }

            $deliveryCost = $rule->apply($totalProductsCost);
        }

        return $totalProductsCost + $deliveryCost;
    }
}
