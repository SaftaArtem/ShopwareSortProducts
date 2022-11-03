<?php

namespace ItdelightArraySorts\Util\Lifecycle\Traits;

use Shopware\Core\System\CustomField\CustomFieldTypes;

trait CustomFieldStorageTrait
{
    private array $customFields = [
        'itdelight_array_sort' => [
            [
                'name' => 'itdelight_array_sort_index',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Sort index',
                        'en-GB' => 'Sort index'
                    ]
                ]
            ]
        ]
    ];
}
