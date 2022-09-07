<?php
$coll = [7, 2, 9, 10, -2, 0];
$typeOfSort = 'Asc';
function AscDescSort($coll, $typeOfSort)
{
    $size = count($coll);
    do {
        $swapped = false;
        for ($i = 0; $i < $size - 1; $i++) {

            $some = $typeOfSort == 'Asc' ?  $coll[$i] > $coll[$i + 1] : $coll[$i] < $coll[$i + 1];

                if ($some) {
                    $temp = $coll[$i];
                    $coll[$i] = $coll[$i + 1];
                    $coll[$i + 1] = $temp;
                    $swapped = true;
                }
        }
        if ($typeOfSort !== 'Asc' and $typeOfSort !== 'Desc') {
            return 'Неверные данные';
        }
        $size--;
    } while ($swapped);
    return $coll;
}

print_r(AscDescSort($coll, $typeOfSort));


// version 2


function order($arr, $typeOfSort)
{
    if ($typeOfSort !== "Asc" && $typeOfSort !== "Desc") {
        return "false data";
    }
    $res = [];

    foreach ($arr as $key => $value) {
        $some = $typeOfSort == 'Asc' ? min($arr) == $value : max($arr) == $value;
        if ($some) {
            $res[] = $value;
            unset($arr["$key"]);
        }
    }

    return $res;
}

$type = "Desc";
$arr = array(9, 8, 3, 7, 4, 6, 5);
print_r(order($arr, $type));






