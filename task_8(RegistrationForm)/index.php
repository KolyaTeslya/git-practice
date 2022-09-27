<?php

require 'vendor/autoload.php';

use donkeylogger\{FileWriter,
    FileFormatter,
    Logger
};

use ns\{PeopleCollection,
    PostVerificator,
    SessionEngine,
    Validator,
    EmailValidator,
    PasswordValidator,
};

session_start();//сессия
date_default_timezone_set('Europe/Kiev');//правильное время

$engine = new SessionEngine();//для работы с данными сессии
$validator = new Validator();
$engine->BlockState(5);//блокировка-разблокировка формы по времени
$logger = "";

if (sizeof($_POST) != 0) {

    $engine->clearErrors();//чищу ошибки будущего ответа

    $formatter = new FileFormatter();//форматтер создаётся один раз.
    $writer = new FileWriter($formatter);//один раз создайтся врайтер, но он использует уже созданный форматтер
    $logger = new Logger($writer);//ну и создаётся логер, подхватывающий ранее созданный врайтер


    if (!PostVerificator::verify($_POST)) {
        $logger->log("COMMON ERROR", "request data isn't correct! not all required data find!");
        $engine->setNewErrorMessage("request data isn't correct! not all required data find!");
    }

    $email = new EmailValidator();
    $pass = new PasswordValidator();

    if ($email->validateWithFilter($_POST['email']) == false) {
        $logger->log("EMAIL VALIDATION ERROR", "email " . $_POST['email'] . " is incorrect");
        $engine->setNewErrorMessage("email " . $_POST['email'] . " is incorrect");
    }

    if ($email->validateWithRegExp($_POST['email']) == false) {
        $logger->log("EMAIL FORMAT ERROR", "email " . $_POST['email'] . " not match to template!");
        $engine->setNewErrorMessage("email " . $_POST['email'] . " not match to template!");
    }

    if (PeopleCollection::isRegisteredInPeopleCollection($_POST['email'])) {//если нашел почту в базе
        $logger->log("EMAIL ACCESS ERROR", "email " . $_POST['email'] . " cannot be use. reserved!");
        $engine->setNewErrorMessage("email " . $_POST['email'] . " cannot be use. reserved!");
    }


    if ($_POST['password'] !== $_POST['confirmpassword']) {//сначала проверяю н совпадение, а потом всё остальное
        $logger->log("PASSWORD MATCH ERROR", " password not equal to confirmation!");
        $engine->setNewErrorMessage("password not equal to confirmation!");
    }

    if ($pass->validateWithRegExp($_POST['password']) == false) {
        $logger->log("PASSWORD FORMAT ERROR", "password not match to template!");
        $engine->setNewErrorMessage("password not match to template!");
    }


    $engine->setGoodOrAttemptForRegistration();//считаю неправильные регистрации или фиксирую факт правильной
    $engine->setBlock(3);//проверяю число неуспешных попыток и блокирую форму при превышении


}

?>

<!DOCTYPE html>
<head>
    <title></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    div {
        column-gap: 10px;
    }

</style>

<body class="mx-auto w-50">

<?php { ?>
    <?php foreach ($engine->getErrorList() as $v) { ?>
        <div><label><?= $v ?> </label></div>
    <?php }
}


if ($engine->isGodUser()) { ?>
    <div><label><?= $engine->messageForGoodUser() ?></label></div>
<?php }

if ($engine->isBlocked()) { ?>
    <div><label>OOPS, TRY AGAIN LATER!</label></div>
<?php }


if ($engine->isVisibileForm()) {
    ?>

    <form action="" method="post">

        <div class="form-group row">
            <label for="userName" class="col-sm-2 col-form-label">Name</label>
            <input type="text" class="form-control" name="username" id="userName"
                   placeholder="Enter your name">
        </div>

        <div class="form-group row">
            <label for="userSurName">Surname</label>
            <input required type="text" class="form-control" id="userSurName" name="usersurname"
                   aria-describedby="emailHelp"
                   placeholder="Enter your surname">
        </div>

        <div class="form-group row">
            <label for="email">Email address</label>
            <input required type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                   placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">(xxx@xxx.xxx)</small>
        </div>

        <div class="form-group row">
            <label for="password">Password</label>
            <input required type="password" class="form-control" id="password" name="password" placeholder="Password">
            <small id="passHelp" class="form-text text-muted">мин. 8 символов. обязательно должен содержать: большую
                букву,
                маленькую букву, цифру, спец-символ</small>
        </div>

        <div class="form-group row">
            <label for="confirmPassword">Confirm Password</label>
            <input required type="password" class="form-control" id="confirmPassword" name="confirmpassword"
                   placeholder="Password">
        </div>

        <button type="submit" class="btn btn-warning btn-block mt-3">Submit</button>

    </form>
<?php } ?>

</body>
</html>