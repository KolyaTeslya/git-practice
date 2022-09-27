<?php

class Collection
{

    protected $uri = "";

    public function getItems()
    {
        $coll = json_decode(file_get_contents($this->uri),
            true)['coll'][0];
        return $coll;
    }
}