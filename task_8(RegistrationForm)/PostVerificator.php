<?php

namespace ns;

class PostVerificator
{
    private static $maskArray = [
        'username',
        'usersurname',
        'email',
        'password',
        'confirmpassword',
    ];


    public static function verify(array $data): bool
    {
        if (array_diff_key($data, array_flip(self::$maskArray)) == [])//если разницы с маской ключей нет
        {//проверим на пустоту значений
            foreach ($data as $variant) {
                if (empty($variant)) return false;
            }
            return true;
        }

        return false;
    }

}