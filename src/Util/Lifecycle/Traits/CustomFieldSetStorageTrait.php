<?php declare(strict_types=1);

namespace ItdelightArraySorts\Util\Lifecycle\Traits;

trait CustomFieldSetStorageTrait
{
    /**
     * @summary Predefined Custom Sets
     */
    private array $customFieldSets = [
        'itdelight_array_sort' => [
            'name' => 'itdelight_array_sort',
            'config' => [
                'label' => [
                    'de-DE' => 'Itdelight array sort',
                    'en-GB' => 'Itdelight array sort'
                ]
            ],
            'relations' => [[
                'entityName' => 'product'
            ]]
        ]
    ];
}
