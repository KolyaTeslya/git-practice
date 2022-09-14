<?php

class Collection
{

    protected $url = "";

    public function getItems() : array
    {
        $data = json_decode(file_get_contents($this->url),
            true)['data'][0];
        return $data;
    }
}