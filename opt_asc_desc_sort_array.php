<?php
$coll = [7, 2, 9, 10, -2, 0];
$typeOfSort = 'Asc';
function AscDescSort($coll, $typeOfSort)
{
    $size = count($coll);
    do {
        $swapped = false;
        for ($i = 0; $i < $size - 1; $i++) {
            if ($typeOfSort == 'Asc') {
                if ($coll[$i] > $coll[$i + 1]) {
                    $temp = $coll[$i];
                    $coll[$i] = $coll[$i + 1];
                    $coll[$i + 1] = $temp;
                    $swapped = true;
                }
            } else {
                if ($coll[$i] < $coll[$i + 1]) {
                    $temp = $coll[$i];
                    $coll[$i] = $coll[$i + 1];
                    $coll[$i + 1] = $temp;
                    $swapped = true;
                }
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
