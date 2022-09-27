<?php

namespace ns;

class PasswordValidator extends Validator
{

    public function validateWithFilter(string $dataToValidate, $filter = ""): bool|string
    {
        $result = htmlspecialchars($dataToValidate);
        if (is_string($result)) {
            $this->data = $result;
        }
        return $result;
    }

    public function validateWithRegExp(string $dataToValidate, string $regExp=''): bool|string
    {
        $this->validateWithFilter($dataToValidate);
        $dataToValidate =  $this->data;
        $reg = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^\w\s]).{8,}#';
        return parent::validateWithRegExp($dataToValidate, $reg);
    }

}