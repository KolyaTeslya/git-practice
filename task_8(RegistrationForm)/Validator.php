<?php

namespace ns;


class Validator implements ValidatorInterface
{
    protected string $data;

    public function validateWithFilter(string $dataToValidate, $filter = ""): bool|string
    {
        $result = filter_var($dataToValidate, $filter);
        if (is_string($result)) {
            $this->data = $result;
        }
        return $result;
    }


    public function getData(): string
    {
        return $this->data;
    }

    public function validateWithRegExp(string $dataToValidate, string $regExp=''): bool|string
    {
        $result = (preg_match($regExp, $dataToValidate));
        if ($result == 1) {
            return $dataToValidate;
        }
        return false;
    }
}