<?php declare(strict_types=1);

namespace ItdelightArraySorts\Service\Type;

interface SortTypeInterface
{
    public function sort(array $data): array;
}
