<?php

namespace Acme\DeliveryCostRules;


class RuleValidator {

    public function isValid($rule)
    {
        if (!isset($rule['min'])) {
            throw new \Exception(sprintf('Min value is missing for rule: %s', $rule['name']));
        }

        if (!isset($rule['max'])) {
            throw new \Exception(sprintf('Max value is missing for rule: %s', $rule['name']));
        }

        if (!isset($rule['cost'])) {
            throw new \Exception(sprintf('Cost value is missing for rule: %s', $rule['name']));
        }

        if ($rule['min'] > $rule['max']) {
            throw new \Exception(sprintf('Invalid rule %s minimum value should be smaller than maximum value', $rule['name']));
        }

        return true;
    }
}