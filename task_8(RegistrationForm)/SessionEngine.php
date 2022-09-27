<?php

namespace ns;

class SessionEngine
{

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = '';//счётчик попыток, он же индикатор того, что был хоть один POST
            $_SESSION['username'] = '';//имя
            $_SESSION['usersurname'] = '';//фамилия
            $_SESSION['mail'] = '';
            $_SESSION['goodUser'] = false;//когда прошел регистрацию успешно
            $_SESSION['form'] = true;//показывать форму регистрации
            $_SESSION['errors'] = false;//показывать ошибки
            $_SESSION['blocked'] = false;//заблокировано
            $_SESSION['blocktime'] = 0;//время блокировки
            $_SESSION['errorsdump'] = [];//тут лежат конкретные ошибки, чистящиеся каждый раз при получении новых данных
        }
    }


    public function isVisibileForm()
    {
        return $_SESSION['form'];
    }


    public function BlockState($minutesForBlock)
    {
        $this->clearErrors();//т.к. если заходим сюда - то без пост-запроса, ибо с заблокированной формы
        if ($_SESSION['blocktime'] != 0)//если была блокировка
        {
            if (time() - $_SESSION['blocktime'] >= $minutesForBlock * 60) {//и прошло бльше X минут
                unset($_SESSION['user']);//чищу массив
            }
        }
    }

    public function clearErrors()
    {
        $_SESSION['errorsdump'] = [];//каждый рас чистится при новом пуле данных
    }

    public function setNewErrorMessage(string $message)
    {
        array_push($_SESSION['errorsdump'], $message);
    }

    public function getErrorList()
    {
        return $_SESSION['errorsdump'];
    }

    public function setGoodUser()
    {
        $_SESSION['goodUser'] = true;
    }

    public function setGoodOrAttemptForRegistration()
    {

        if (sizeof($_SESSION['errorsdump']) == 0) {
            $_SESSION['errors'] = false;
            $this->setGoodUser();
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['usersurname'] = $_POST['usersurname'];
        } else {
            $_SESSION['errors'] = true;
            $_SESSION['user']++;
        }//увеличиваю число неудачных регистраций при получении формы


    }

    public function setBlock($attempts)
    {
        if ($_SESSION['user'] >= $attempts) { //если X неудачные попытки
            $_SESSION['blocked'] = true;//заблокировано
            $_SESSION['blocktime'] = time();//время блокировки
            $_SESSION['form'] = false;

        }


    }

    public function isBlocked(): bool
    {
        return $_SESSION['blocked'];
    }


    public function isGodUser(): bool
    {
        if ($_SESSION['goodUser']) {
            $_SESSION['form'] = false;//не показывать форму регистрации
            $_SESSION['errors'] = false;//не показывать ошибки


        }

        return $_SESSION['goodUser'];
    }

    public function getValue($key)
    {

        return $_SESSION[$key];
    }


    public function messageForGoodUser(): string
    {

        if ($this->isGodUser()) {
            if ($_SESSION['mail'] == '') {
                $_SESSION['mail'] = $_POST['email'];
                $userName = $this->getValue('username');
                $userSurName = $this->getValue('usersurname');
                return " Dear $userName $userSurName, your account has been created.";
            } else {
                return " Registration already completed.";
            }
        }
        return "";
    }


}