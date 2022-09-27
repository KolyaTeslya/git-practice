<?php

namespace ns;

class PeopleCollection
{
    private static array $PeopleCollection = [
        "Semenov" => "sem@www.dfg",
        "Ivanov" => "iva@asd.cde",
        "Kirov" => "ccc@caf.pol",
        "Zdorov" => "xxx@yyy.www",
    ];

    public static function isRegisteredInPeopleCollection(string $whatFind): bool
    {
        foreach (self::$PeopleCollection as $variant) {
            if ($whatFind == $variant) return true;
        }
        return false;
    }

}