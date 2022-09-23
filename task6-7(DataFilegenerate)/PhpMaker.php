<?php

class PhpMaker extends Maker
{

    public function make(array $data)
    {
        $fop = fopen("php://temp", 'r+');
        fputs($fop, print_r($data, true));
        rewind($fop);
        return $fop;
    }

}