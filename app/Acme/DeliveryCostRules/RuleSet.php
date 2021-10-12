<?php

namespace Acme\DeliveryCostRules;

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
        $ruleValidator = new RuleValidator();

        foreach ($ruleData as $data) {
            if ($ruleValidator->isValid($data)) {
                $this->rules[] = new Rule($data['name'], $data['min'], $data['max'], $data['cost']);
            }
        }
    }

    public function getRules(): array
    {
        return $this->rules;
    }
}
