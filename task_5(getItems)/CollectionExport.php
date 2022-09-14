<?php

class CollectionExport
{
    public function makeDataFormatedExport(Collection $data)
    {
        return $data->getItems();
    }

    public function export(Collection $data)
    {
        return $data->getItems();
    }
}