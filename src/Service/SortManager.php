<?php declare(strict_types=1);

namespace ItdelightArraySorts\Service;

use ItdelightArraySorts\Service\Type\SortTypeInterface;

class SortManager implements SortManagerInterface
{
    private SortTypeInterface $sortType;

    public function __construct(
        SortTypeInterface $sortType
    )
    {
        $this->sortType = $sortType;
    }

    public function sort(array $data): array
    {
        return $this->sortType->sort($data);
    }
}
