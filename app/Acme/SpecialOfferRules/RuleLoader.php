<?php

namespace Acme\SpecialOfferRules;

class RuleLoader implements RuleLoaderInterface
{
    const SPECIAL_OFFER_RULES_FILE = __DIR__.'/../config/special_offer_rules.json';

    public function loadRules(): array
    {
        if (!file_exists(self::SPECIAL_OFFER_RULES_FILE)) {
            throw new \Exception(sprintf('Special offer rule file not found %s', self::SPECIAL_OFFER_RULES_FILE));
        }

        $data = json_decode(file_get_contents(self::SPECIAL_OFFER_RULES_FILE), true);

        return $data;
    }
}
