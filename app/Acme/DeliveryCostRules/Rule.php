<?php

namespace Acme\DeliveryCostRules;

class Rule {

    public function __construct(private $name, private $min, private $max, private $cost) {}

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of min
     */ 
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * Set the value of min
     *
     * @return  self
     */ 
    public function setMin(int $min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get the value of max
     */ 
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * Set the value of max
     *
     * @return  self
     */ 
    public function setMax(int $max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Get the value of cost
     */ 
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * Set the value of cost
     *
     * @return  self
     */ 
    public function setCost(float $cost)
    {
        $this->cost = $cost;

        return $this;
    }

    public function apply($totalPrice)
    {
        if ($totalPrice >= $this->getMin() && $totalPrice < $this->getMax()) {
            return $this->getCost();
        }
    }
}