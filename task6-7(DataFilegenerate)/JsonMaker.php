<?php

class JsonMaker extends Maker
{
    public function make(array $data)
    {
        $fop = fopen("php://temp", 'r+');
        fputs($fop, json_encode($data));
        rewind($fop);
        return $fop;
    }
}