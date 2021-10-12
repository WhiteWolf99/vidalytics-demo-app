<?php

namespace Acme\SpecialOfferRules;

class RedWidgetRule implements RuleInterface
{
    public function apply(array $lineItems): array
    {
        $redFound = false;
        foreach ($lineItems as $id => $lineItem) {
            if ($lineItem->getCode() == 'R01' && !$redFound) {
                $redFound = true;
            } elseif ($lineItem->getCode() == 'R01' && $redFound) {
                $newReducedItem = clone $lineItem;
                $newReducedItem->setPrice($lineItem->getPrice() / 2);
                $lineItems[$id] = $newReducedItem;
                break;
            }
        }

        return $lineItems;
    }
}
