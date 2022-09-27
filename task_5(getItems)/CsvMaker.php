<?php

class CsvMaker extends Maker
{


    function array_2_csv($array)
    {
        $csv = array();
        foreach ($array as $item) {
            if (is_array($item)) {
                $csv[] = PHP_EOL . $this->array_2_csv($item);
            } else {
                $csv[] = $item;
            }
        }
        return implode(';', $csv);
    }

    public function make(array $data)
    {
        $d = $this->array_2_csv($data);
        $fop = fopen("php://temp", 'r+');
        fputs($fop, $d);
        rewind($fop);
        return $fop;
    }
}