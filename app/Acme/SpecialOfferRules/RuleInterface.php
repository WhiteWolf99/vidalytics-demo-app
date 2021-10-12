<?php

namespace Acme\SpecialOfferRules;

interface RuleInterface
{
    public function apply(array $lineItems):array;
}
