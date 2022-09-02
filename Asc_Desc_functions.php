<?php

$coll = [7, 2, 9, 10, -2, 0];
$typeOfSort = 'Asc';

function AscDescSort($coll, $typeOfSort)
{

    if ($typeOfSort == 'Asc') {
        $size = count($coll);

        do {

            $swapped = false;

            for ($i = 0; $i < $size - 1; $i++) {
                if ($coll[$i] > $coll[$i + 1]) {
                    $temp = $coll[$i];
                    $coll[$i] = $coll[$i + 1];
                    $coll[$i + 1] = $temp;
                    $swapped = true;
                }
            }
            $size--;
        } while ($swapped);

        return $coll;

    } if ($typeOfSort == 'Desc') {

    $size = count($coll);

    do {

        $swapped = false;

        for ($i = 0; $i < $size - 1; $i++) {
            if ($coll[$i] < $coll[$i + 1]) {
                $temp = $coll[$i];
                $coll[$i] = $coll[$i + 1];
                $coll[$i + 1] = $temp;
                $swapped = true;
            }
        }
        $size--;
    } while ($swapped);

    return $coll;

} else {
    return 'Неверные данные';
}
}

print_r(AscDescSort($coll, $typeOfSort));

?>
