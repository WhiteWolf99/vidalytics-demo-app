<?php

namespace Acme\SpecialOfferRules;

interface RuleLoaderInterface
{
    public function loadRules(): array;
}
