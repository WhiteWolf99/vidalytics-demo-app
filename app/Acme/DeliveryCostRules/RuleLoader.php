<?php

namespace Acme\DeliveryCostRules;

class RuleLoader implements RuleLoaderInterface
{
    const DELIVERY_COST_RULES_FILE = __DIR__.'/../config/delivery_cost_rules.json';

    public function loadRules(): array
    {
        if (!file_exists(self::DELIVERY_COST_RULES_FILE)) {
            throw new \Exception(sprintf('Delivery cost rule file not found %s', self::DELIVERY_COST_RULES_FILE));
        }

        $data = json_decode(file_get_contents(self::DELIVERY_COST_RULES_FILE), true);

        foreach ($data as $id => $rule) {
            if (NULL == $rule['max']) {
                $data[$id]['max'] = PHP_INT_MAX;
            }
        }

        return $data;
    }
}
