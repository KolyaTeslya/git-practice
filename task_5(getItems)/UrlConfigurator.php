<?php

class UrlConfigurator
{
    private static string $baseurl = "https://fakerapi.it/api/v1/";

    public static function makeUrl($resource, $quantity, $locale): string
    {
        return self::$baseurl . $resource . "?_quantity=$quantity&_locale=$locale";
    }

}