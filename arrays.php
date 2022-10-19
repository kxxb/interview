<?php


$array = [
    ['id' => 1, 'date' => "12.01.2020", 'name' => "test1"],
    ['id' => 2, 'date' => "02.05.2020", 'name' => "test2"],
    ['id' => 4, 'date' => "08.03.2020", 'name' => "test4"],
    ['id' => 1, 'date' => "22.01.2020", 'name' => "test1"],
    ['id' => 2, 'date' => "11.11.2020", 'name' => "test4"],
    ['id' => 3, 'date' => "06.06.2020", 'name' => "test3"]
];


var_dump(flipElements($array));

/**
 * 1 выделить уникальные записи (убрать дубли) в отдельный массив.
 *   в конечном массиве не должно быть элементов с одинаковым id.
 *
 * @param   array  $array
 *
 * @return array
 */
function uniqueElements(array $array): array
{
    $n = [];
    $f = function ($item, $key) use (&$n) {
        $n[$item['id']] = $item;
    };
    array_walk($array, $f);

    return $n;
}


/**
 * 2. отсортировать многомерный массив по ключу (любому)
 *
 *  с удалением дублей
 *
 * @param   array   $array
 * @param   string  $sortKey
 *
 * @return array
 */
function sortMultiDimensional(array $array, string $sortKey = 'name'): array
{
    $n = [];
    $f = function ($item, $key) use (&$n, $sortKey) {
        switch ($sortKey) {
            case 'id':
                $n[$item[$sortKey]] = $item;
                break;
            case 'date':
                $n[strtotime($item[$sortKey])] = $item;
                break;
            case 'name':
                $n[$item[$sortKey]] = $item;
                break;
        }

    };
    array_walk($array, $f);
    ksort($n);

    return $n;
}


/**
 * 2. отсортировать многомерный массив по ключу (любому)
 *  сортирует и не меняет состав массива
 *
 * @param   array   $array
 * @param   string  $sortKey
 *
 * @return array
 */
function sortMultiDimensional2(array $array, string $sortKey = 'id'): array
{

    $f = function ($a, $b) use ($sortKey) {
        switch ($sortKey) {
            case 'id':
                return $a[$sortKey] <=> $b[$sortKey];
            case 'date':
                return strtotime($a[$sortKey]) <=> strtotime($b[$sortKey]);
            case 'name':
                return strcmp($a[$sortKey], $b[$sortKey]);
            default:
                return strcmp($a[$sortKey], $b[$sortKey]);
        }
    };
    usort($array, $f);

    return $array;
}

/**
 * 3. вернуть из массива только элементы,
 *    удовлетворяющие внешним условиям
 *  (например элементы с определенным `id`)
 *
 * @param   array   $array
 * @param   string  $searchKey
 * @param   string  $searchValue
 *
 * @return array
 */
function searchElements(array $array, string $searchKey = 'id', string $searchValue = '1'): array
{
    $n = [];
    $f = function ($item, $key) use (&$n, $searchKey, $searchValue) {
        if ($item[$searchKey] == $searchValue){
            $n[] = $item;
        }

    };
    array_walk($array, $f);
    return $n;
}





/**
 * 4. изменить в массиве значения и ключи (использовать name => id в качестве пары ключ => значение)
 *
 *  Если параметр $strict = true
 *   тогда будет проверяться добавлен ли уже такой ключ в результирующий массив
 *
 *  Если параметр $strict = false
 *   в результирующем массиве будет записано последнее значение, которое встретилось в исходном массиве
 *
 * @param   array  $array
 * @param   bool   $strict
 *
 * @return array
 */
function flipElements(array $array, bool $strict = true):array
{
    $n = [];
    $f = function ($item, $key) use (&$n, $strict) {
        if ($strict){
            if(!array_key_exists($item['name'], $n)) {
                $n[$item['name']] = $item['id'];
            }

            } else {
            $n[$item['name']] = $item['id'];
        }

    };
    array_walk($array, $f);
    return $n;
}
