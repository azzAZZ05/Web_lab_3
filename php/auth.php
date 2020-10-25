<?php
require_once (__DIR__.'/functions.php');
session_start();
$users = array(
    "admin" => md5("admin"),
    "qwerty" => md5("qwerty"),
    "user" => md5("user")
);
if(!isset($_POST['token'])) header("location: ../journal.php");
$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);
$token = htmlspecialchars($_POST['csrf_token']);
check_data($login, $password, $token);
if (!isset($_SESSION['error'])) {
        if (isset($users[$login])) {
            if ($users[$login] === md5($password)) {
                $_SESSION['user'] = $login;

                header("location: ../journal.php");
            } else {
                $_SESSION['error'] = "Неверный пароль";
            }
        } else {
            $_SESSION['error'] = "Пользователь не найден";
        }
}
header("location: ../journal.php");
?>
