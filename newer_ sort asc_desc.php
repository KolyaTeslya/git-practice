<?php
function order($arr, $type)
{
    $count = count($arr);
    $temp = 0;
    for ($i = 0; $i < $count - 1; $i++) {
        for ($j = 0; $j < $count - 1 - $i; $j++) {
            if ($type == "Asc") {
                if ($arr [$j] > $arr [$j + 1]) {
                    $temp = $arr[$j];
                    $arr[$j] = $arr [$j + 1];
                    $arr [$j + 1] = $temp;
                }
            }
            if ($type == "Desc") {
                if ($arr [$j] < $arr [$j + 1]) {
                    $temp = $arr[$j];
                    $arr[$j] = $arr [$j + 1];
                    $arr [$j + 1] = $temp;
                }
            }
        }
    }
    if ($type !== "Asc" && $type !== "Desc") {
        return "Неверные данные";
    }
    return $arr;
}

$type = "Desc";
$arr = array(1, 9, 2, 8, 3, 7, 4, 6, 5);
print_r(order($arr, $type));