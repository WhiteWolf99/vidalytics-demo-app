<?php

namespace Acme\DeliveryCostRules;

interface RuleLoaderInterface {
    
    public function loadRules():array;
}