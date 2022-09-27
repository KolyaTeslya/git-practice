<?php

namespace ns;

/** валидация почты
 *
 */
class EmailValidator extends Validator
{

    public function validateWithFilter(string $dataToValidate, $filter = ""): bool|string
    {
        return parent::validateWithFilter($dataToValidate, FILTER_SANITIZE_EMAIL);
    }

    public function validateWithRegExp(string $dataToValidate, string $regExp=''): bool|string
    {
        $dataToValidate =  $this->data;
        return parent::validateWithRegExp($dataToValidate, '/...@...\\..../');
    }

}
