<?php

namespace Acme\SpecialOfferRules;

class RuleSet
{
    private $rules = [];

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $ruleLoader = new RuleLoader();

        $ruleData = $ruleLoader->loadRules();

        foreach ($ruleData as $data) {
            $className = 'Acme\\SpecialOfferRules\\'.$data['implementation'];
            if (class_exists($className)) {
                $this->rules[] = new $className;
            }
        }
    }

    public function getRules(): array
    {
        return $this->rules;
    }
}
