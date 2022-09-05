<?php


function AscSort($coll)
{
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

}

print_r(AscSort([7, 2, 9, 10, -2, 0]));


function DescSort($coll)
{
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
}

print_r(DescSort([7, 2, 9, 10, -2, 0]));

?>


