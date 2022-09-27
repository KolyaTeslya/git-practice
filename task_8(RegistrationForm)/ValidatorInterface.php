<?php

namespace ns;

interface ValidatorInterface
{
    public function validateWithFilter(string $dataToValidate, $filter=""):bool|string;
    public function validateWithRegExp(string $dataToValidate, string $regExp=""):bool|string;

}