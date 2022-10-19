<?php


$array = [
            ['id' => 1, 'date' => "12.01.2020", 'name' => "test1"],
            ['id' => 2, 'date' => "02.05.2020", 'name' => "test2"],
            ['id' => 4, 'date' => "08.03.2020", 'name' => "test4"],
            ['id' => 1, 'date' => "22.01.2020", 'name' => "test1"],
            ['id' => 2, 'date' => "11.11.2020", 'name' => "test4"],
            ['id' => 3, 'date' => "06.06.2020", 'name' => "test3"]
        ];


$array1 = [
    ['id' => 1],
    ['id' => 2],
    ['id' => 4],
    ['id' => 1],
    ['id' => 2],
    ['id' => 3]
];


var_dump(uniqueElements($array));

/**
 * 1 выделить уникальные записи (убрать дубли) в отдельный массив.
 *   в конечном массиве не должно быть элементов с одинаковым id.
 *
 * @param   array  $array
 *
 * @return array
 */
function uniqueElements(array $array):array
{
    $n = [];
    $f = function($item, $key) use (&$n)
    {
        $n[$item['id']]=$item;
    };
    array_walk($array, $f);
    return $n;
}






