<?php

function token_gen()
{
    $_SESSION['token'] = password_hash('admin', PASSWORD_DEFAULT);
    return $_SESSION['token'];
}
function check_data($login, $password, $token)
{
#Замена проверка регулярками preg_match
    if (!preg_match("/^[a-zA-Z0-9]+$/", $login)) $_SESSION['error'] = "Недопустимые символы в логине";
    if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) $_SESSION['error'] = "Недопустимые символы в пароле";
    if($token != $_SESSION['token']) $_SESSION['error'] = "Токен неверный";
}
function sql_connect()
{
    $argscount = func_num_args();
    $db = func_get_arg(0);
    $link = mysqli_connect("localhost", "root", "", $db);
    if($argscount == 2)
    {
        $login = mysqli_real_escape_string($link, func_get_arg(1));
        $result = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$login'");
        return $result;
    }
    if($argscount == 3)
    {
        $num = intval( func_get_arg(1));
        $let = intval(func_get_arg(2));
        $result = mysqli_query($link, "SELECT * FROM `students` WHERE `number` = '$num' AND `letter` = '$let'");
        return $result;
    }
}