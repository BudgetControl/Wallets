<?php
declare(strict_types=1);

namespace Budgetcontrol\Wallet\Entity;

final class Filter {

    protected array $filters = [];

    private const FILTERS = [
        'balance',
        'type',
        'installement',
        'currency',
        'archived',
    ];

    public function __construct(array $filters) {
        $this->validate($filters);

        foreach($filters as $key => $filter) {
            if(strpos($filter,'|') !== false) {
                $build = explode('|', $filter);
                $filter = [
                    'condition' => $build[0],
                    'value' => $build[1]
                ];
            } elseif(strpos($filter, ',') !== false) {
                $build = explode(',', $filter);
                $filter = [
                    'value' => $build
                ];
            } else {
                $filter = [
                    'value' => $filter
                ];
            }

            $this->filters[$key] = $filter;
        }
        
    }
    
    private function validate(array $filters) {
        foreach($filters as $key => $value) {
            if(!in_array($key, self::FILTERS)) {
                throw new \InvalidArgumentException("Invalid filter key: $key");
            }
        }
    }

    /**
     * Get the value of filters
     *
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }
}