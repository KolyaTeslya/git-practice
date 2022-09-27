<?php

class CsvCollectionExport extends CollectionExport
{
    public function implode_r($glue, $pieces)
    {
        $out = '';
        foreach ($pieces as $piece) {
            if (is_array($piece)) {
                if ($out == '') {
                    $out = $this->implode_r($glue, $piece);
                } else {
                    $out .= $this->implode_r($glue, $piece);
                }
            } else {
                if ($out == '') {
                    $out .= $piece;
                } else {
                    $out .= $glue . $piece;
                }
            }
        }
        return $out;
    }

    public function makeArrayFormateto(Collection $coll, $delimiter = ';')
    {
        $arrayToConvertInCsv = parent::export($coll);
        $result = $this->implode_r($delimiter, $arrayToConvertInCsv);
        return $result;
    }
}