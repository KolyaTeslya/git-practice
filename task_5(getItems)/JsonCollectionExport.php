<?php

class JsonCollectionExport extends CollectionExport
{
    public function makeDataFormatedExport(Collection $data)
    {
        return json_encode(
            parent::export($data)
        );
    }
}