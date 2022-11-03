<?php declare(strict_types=1);

namespace ItdelightArraySorts\Service;

interface SortManagerInterface
{
    public function sort(array $data): array;
}
