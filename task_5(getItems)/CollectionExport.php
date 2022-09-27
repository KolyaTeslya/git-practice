<?php

class CollectionExport
{
    public function makeArrayFormateto(Collection $coll)
    {
        return $coll->getItems();
    }

    public function export(Collection $coll)
    {
    }
}