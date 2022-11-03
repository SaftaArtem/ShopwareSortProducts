<?php declare(strict_types=1);

namespace ItdelightArraySorts\Service\Type;

class QuickSort implements SortTypeInterface
{
    public function sort(array $data): array
    {
        // count () возвращает количество элементов в массиве
        $count = count($data);

        // Определяем, нужна ли сортировка (исключая не массив, а количество элементов массива меньше или равно 1)
        if ($count <= 1) {
            return $data;
        }

        // Определяем промежуточное значение, которое является ссылочным значением
        $baseValue = $data[0];
        /**
         * Определить два пустых массива для разделения исходного массива слева и справа
         * $ leftArr хранит массив меньше, чем эталонное значение, которое является левым разделом
         * $ rightArr хранит массив больше, чем эталонное значение, которое является правильным разделом
         */

        $leftArr = $rightArr = [];

        // Сравнить среднее значение массива, обратить внимание на значение $ i, начиная с 1 (или $ i = 0; $ i <$ count-1)
        for ($i = 1; $i < $count; $i++) {
            if ($baseValue['stock'] > $data[$i]['stock']) {
                // Меньше значения эталона помещается в левый раздел
                $leftArr[] = $data[$i];
            } else {
                // Меньше, чем эталонное значение помещается в правильный раздел
                $rightArr[] = $data[$i];
            }
        }

        // Рекурсивная сортировка подпоследовательностей элементов, меньших, чем контрольное значение, и подпоследовательностей элементов, превышающих контрольное значение
        $leftArr = $this->sort($leftArr);
        $rightArr = $this->sort($rightArr);

        // Возвращаем объединенный и отсортированный массив, помещаем значения эталона в массив и объединяем их вместе, обращаем внимание на порядок, левый раздел помещается впереди, значение эталона размещается посередине, а правый раздел помещается сзади
        return array_merge($leftArr, [$baseValue], $rightArr);
    }
}