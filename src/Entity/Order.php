<?php
declare(strict_types=1);

namespace Budgetcontrol\Wallet\Entity;

final class Order {

    protected array $order = [];

    private const FILTERS = [
        'created_at',
        'updated_at',
        'name',
        'balance',
        'sorting',
    ];

    public function __construct(array $filters) {
        $this->validate($filters);

        foreach($filters as $key => $order) {
            $this->order[$key] = $order;
        }
        
    }
    
    private function validate(array $filters) {
        foreach($filters as $key => $value) {
            if(!in_array($key, self::FILTERS)) {
                throw new \InvalidArgumentException("Invalid order key: $key");
            }
        }
    }


    /**
     * Get the value of order
     *
     * @return array
     */
    public function getOrder(): array
    {
        return $this->order;
    }
}